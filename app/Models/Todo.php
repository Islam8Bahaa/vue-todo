<?php

namespace App\Models;

use App\Enums\PriorityEnum;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'title', 'status' , 'priority','user_id','description'
    ];

    protected $casts = [
        'priority' => PriorityEnum::class
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
