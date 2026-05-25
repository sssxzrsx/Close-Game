<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'discount_price',
        'category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getImageUrlAttribute()
{
    if (!$this->image) {
        return null;
    }
    
    if (filter_var($this->image, FILTER_VALIDATE_URL)) {
        return $this->image;
    }
    
    if (str_starts_with($this->image, 'storage/') || str_starts_with($this->image, '/storage/')) {
        return asset($this->image);
    }
    
    return asset('storage/' . $this->image);
}
}
