<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Invoice extends Model
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'reference',
        'charges',
        'total',
        'note_en',
        'note_fr',
        'note_it',
        'note_ar',
    ];

    protected $searchable = [
        'name',
        'email',
        'phone',
        'type',
        'reference',
        'charges',
        'total',
    ];

    public static $ITEMS = null;

    protected static function booted()
    {
        self::created(function ($Self) {
            foreach (self::$ITEMS as $Item) {
                $Self->Items()->create($Item);
            }
            $Self->update(['total' => $Self->Items()->sum('total')]);
        });

        self::deleted(function ($Self) {
            $Self->Items->each(function ($Item) {
                $Item->delete();
            });
        });
    }

    public function getNoteAttribute()
    {
        return $this->{'note_' . Core::lang()};
    }

    public function Items(): MorphMany
    {
        return $this->morphMany(Item::class, 'target');
    }
}
