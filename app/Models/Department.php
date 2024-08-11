<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $primaryKey = 'DEPTID';
    public $timestamps = false;

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'DEFAULTDEPTID', 'DEPTID');
    }
}
