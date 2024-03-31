<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Exception;

trait HasSearch
{
    public function scopeSearch(Builder $builder, string $term = '')
    {
        if (!$this->searchable) {
            throw new Exception("Please define the searchable property . ");
        }
        foreach ($this->searchable as $searchable) {
            if (Str::contains($searchable, '.')) {
                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $builder->orWhereRelation($relation, $column, 'like', "%$term%");
                continue;
            }
            $builder->orWhere($searchable, 'like', "%$term%");
        }
        return $builder;
    }
}
