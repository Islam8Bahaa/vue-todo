<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToUser
{
    public static function bootBelongsToUser(): void
    {
        if (auth()->check()) {
            $id = auth()->id();
            static::creating(fn(Model $model) => $model->user_id = $id);
            static::addGlobalScope('forUser', fn(Builder $query) => $query->where('user_id', $id));
        }

    }
}
