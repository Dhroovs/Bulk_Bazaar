<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','order_number','status','subtotal','shipping','total',
        'shipping_name','shipping_email','shipping_phone','shipping_address',
        'shipping_city','shipping_state','shipping_zip','notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
        ];
        $color = $badges[$this->status] ?? 'secondary';
        return '<span class="badge bg-'.$color.'">'.ucfirst($this->status).'</span>';
    }
}
