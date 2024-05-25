<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    const TYPE_FIRST = 'first-test-plan';
    const TYPE_SECOND = 'second-test-plan';

    const MAX_TASKS_PER_PLAN_FREE = 1;
    const MAX_TASKS_PER_PLAN_FIRST = 2;

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

    public function scopeMinStength(QueryBuilder $q, int $minStength): QueryBuilder
    {
        return $q->where('strength', '>=', $minStength);
    }
}
