<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $isVendor = $notifiable->isVendor() && !$notifiable->is_admin;
        return [
            'title' => 'Critical Inventory Alert',
            'message' => 'Product listing "' . $this->product->name . '" is low on stock (Only ' . $this->product->stock . ' units left).',
            'url' => $isVendor ? '/vendor/products' : '/admin/products',
            'icon' => '⚠️'
        ];
    }
}
