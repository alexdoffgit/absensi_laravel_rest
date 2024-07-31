<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsenceApproval extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function absence(): BelongsTo
    {
        return $this->belongsTo(Absence::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_user_id', 'USERID');
    }
}
