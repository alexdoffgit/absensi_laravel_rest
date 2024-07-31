<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function leave(): BelongsTo
    {
        return $this->belongsTo(LeaveClass::class, 'leaveclass_id', 'lEAVEID');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'USERID');
    }
}
