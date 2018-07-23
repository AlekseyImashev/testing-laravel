<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * Most popular articles.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param int $take
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeTrending($query, $take = 3)
    {
        return $query->orderBy('reads', 'desc')->take($take)->get();
    }
}
