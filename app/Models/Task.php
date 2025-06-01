<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'due_date', 'completed_at', 'user_id'];
    protected $dates = ['due_date', 'completed_at'];

    // This task belongs to one users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
