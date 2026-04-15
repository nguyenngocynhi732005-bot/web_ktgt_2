<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestSendEmail extends Notification
{
    use Queueable;

    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $items;

    protected float|int $total;

    protected string $paymentMethod;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $items = [], float|int $total = 0, string $paymentMethod = '')
    {
        $this->items = $items;
        $this->total = $total;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Xác nhận đơn hàng')
            ->view('emails.order-confirmation', [
                'user' => $notifiable,
                'items' => $this->items,
                'total' => $this->total,
                'paymentMethod' => $this->paymentMethod,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
