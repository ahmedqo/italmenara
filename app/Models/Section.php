<?php

namespace App\Models;

use App\Functions\Core;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content_en',
        'content_fr',
        'content_it',
        'content_ar',
    ];

    public function getContentAttribute()
    {
        return $this->{'content_' . Core::lang()};
    }

    public function Images(): MorphMany
    {
        return $this->morphMany(Image::class, 'target');
    }
}
