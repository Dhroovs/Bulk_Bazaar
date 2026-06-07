<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Order Placed Successfully',
            'message' => 'Your order #' . $this->order->id . ' for ₹' . number_format($this->order->total_price, 2) . ' has been recorded.',
            'url' => '/my-orders',
            'icon' => '📦'
        ];
    }
}
