<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public static function getByName(string $name): self
    {
        return static::query()
            ->name($name)
            ->firstOrFail();
    }

    public function scopeName(QueryBuilder $q, string $name): QueryBuilder
    {
        return $q->where('name', $name);
    }
}
