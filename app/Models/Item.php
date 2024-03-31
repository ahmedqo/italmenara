<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product',
        'quantity',
        'price',
        'total',
        'target_id',
        'target_type',
    ];

    protected static function booted()
    {
        self::creating(function ($Self) {
            $Self->total = $Self->price * $Self->quantity;
        });
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    public function Target(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'target_type', 'target_id');
    }
}
