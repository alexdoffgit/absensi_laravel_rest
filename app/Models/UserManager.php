<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserManager extends Model
{
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'USERID');
    }

    public function head_manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_manager_id', 'USERID');
    }

    public function vice_manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vice_manager_id', 'USERID');
    }
}
