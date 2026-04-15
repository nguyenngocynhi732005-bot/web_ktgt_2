<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xac nhan don hang</title>
</head>

<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.5;">
    <h2 style="margin-bottom: 8px;">Cảm ơn bạn đã đặt hàng</h2>
    <p style="margin-top: 0;">Xin chào {{ $user->name ?? 'bạn' }}, đơn hàng của bạn đã được ghi nhận.</p>

    <p><strong>Hình thức thanh toán:</strong> {{ $paymentMethod }}</p>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; width: 100%; max-width: 760px; border-color: #d1d5db;">
        <thead style="background: #f3f4f6;">
            <tr>
                <th align="left">Sản phẩm</th>
                <th align="right">Số lượng</th>
                <th align="right">Đơn giá</th>
                <th align="right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item['name'] ?? 'Sản phẩm' }}</td>
                    <td align="right">{{ $item['qty'] ?? 0 }}</td>
                    <td align="right">{{ number_format((float) ($item['price'] ?? 0), 0, ',', '.') }} d</td>
                    <td align="right">{{ number_format((float) ($item['subtotal'] ?? 0), 0, ',', '.') }} d</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">Không có sản phẩm trong đơn.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Tổng cộng</strong></td>
                <td align="right"><strong>{{ number_format((float) $total, 0, ',', '.') }} d</strong></td>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 16px;">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
</body>

</html>
