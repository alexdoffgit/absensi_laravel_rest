<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveClass extends Model
{
    protected $table = 'leaveclass';
    protected $primaryKey = 'LEAVEID';
    public $timestamps = false;
}
