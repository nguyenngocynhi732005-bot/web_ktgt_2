<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Notifications\TestSendEmail;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    private function normalizeCartItem(array $item, int $defaultId): array
    {
        return [
            'id' => (int) ($item['id'] ?? $defaultId),
            'name' => $item['name'] ?? ($item['ten_san_pham'] ?? 'Sản phẩm'),
            'image' => $item['image'] ?? ($item['hinh_anh'] ?? null),
            'price' => (float) ($item['price'] ?? ($item['gia_ban'] ?? 0)),
            'qty' => (int) ($item['qty'] ?? ($item['so_luong'] ?? 0)),
        ];
    }

    private function getNormalizedCart(): array
    {
        $cart = session()->get('cart', []);
        $normalized = [];

        foreach ($cart as $id => $item) {
            $normalized[(string) $id] = $this->normalizeCartItem((array) $item, (int) $id);
        }

        return $normalized;
    }

    public function detail(int $id): View
    {
        $loaicay = DB::table('danh_muc')->get();
        $sanpham = SanPham::with('danhMucs')
            ->where('status', 1)
            ->findOrFail($id);

        return view('caycanh.detail', compact('loaicay', 'sanpham'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:san_pham,id',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $sanpham = SanPham::where('status', 1)->findOrFail($validated['product_id']);
        $cart = $this->getNormalizedCart();

        $key = (string) $sanpham->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += (int) $validated['quantity'];
        } else {
            $cart[$key] = [
                'id' => $sanpham->id,
                'name' => $sanpham->ten_san_pham,
                'price' => (float) $sanpham->gia_ban,
                'image' => $sanpham->hinh_anh,
                'qty' => (int) $validated['quantity'],
            ];
        }

        // Keep legacy keys for compatibility with any existing Blade code.
        foreach ($cart as $id => $item) {
            $cart[$id]['ten_san_pham'] = $item['name'];
            $cart[$id]['gia_ban'] = $item['price'];
            $cart[$id]['hinh_anh'] = $item['image'];
            $cart[$id]['so_luong'] = $item['qty'];
        }

        session()->put('cart', $cart);

        $totalQuantity = collect($cart)->sum(function ($item) {
            return (int) ($item['qty'] ?? ($item['so_luong'] ?? 0));
        });

        if (! $request->expectsJson()) {
            return redirect()->route('cart.order')->with('success', 'Thêm vào giỏ hàng thành công');
        }

        return response()->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'totalQuantity' => $totalQuantity,
        ]);
    }

    public function order(): View
    {
        $loaicay = DB::table('danh_muc')->get();
        $cart = $this->getNormalizedCart();

        return view('caycanh.order', compact('loaicay', 'cart'));
    }

    public function cartdelete(Request $request): RedirectResponse
    {
        $id = (string) $request->input('id');
        $cart = $this->getNormalizedCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.order')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    public function ordercreate(Request $request): RedirectResponse
    {
        $request->validate([
            'hinh_thuc_thanh_toan' => 'nullable|in:1,2,3',
        ]);

        $cart = $this->getNormalizedCart();

        if (empty($cart)) {
            return redirect()->route('cart.order')->with('error', 'Giỏ hàng đang trống.');
        }

        $items = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $qty = (int) ($item['qty'] ?? 0);
            $price = (float) ($item['price'] ?? 0);
            $subtotal = $qty * $price;

            $items[] = [
                'id' => $id,
                'name' => $item['name'] ?? 'Sản phẩm',
                'image' => $item['image'] ?? null,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        $paymentMethod = match ((string) $request->input('hinh_thuc_thanh_toan', '1')) {
            '2' => 'Chuyển khoản',
            '3' => 'Thanh toán VNPay',
            default => 'Tiền mặt',
        };

        $user = $request->user();

        if ($user && !empty($user->email)) {
            try {
                $user->notify(new TestSendEmail($items, $total, $paymentMethod));
            } catch (\Throwable $e) {
                Log::warning('Send order confirmation email failed', [
                    'user_id' => $user->id ?? null,
                    'email' => $user->email ?? null,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('cart.order')->with('success', 'Đặt hàng thành công. Chúng tôi đã gửi email xác nhận.');
    }

       
}
