<?php

namespace App\Models;

use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Request extends Model
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
        'total',
        'message',
    ];

    protected $searchable = [
        'name',
        'email',
        'phone',
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

    public function Items(): MorphMany
    {
        return $this->morphMany(Item::class, 'target');
    }
}
