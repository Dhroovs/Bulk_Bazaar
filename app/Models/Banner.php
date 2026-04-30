<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'image', 'link', 'is_active', 'sort_order'];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
