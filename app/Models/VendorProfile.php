<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'store_description',
        'store_logo',
        'store_banner',
        'commission_rate',
        'earnings',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
