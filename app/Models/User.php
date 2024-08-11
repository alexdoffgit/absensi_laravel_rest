<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'userinfo';
    protected $primaryKey = 'USERID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function pivot_head_manager(): HasOne
    {
        return $this->hasOne(UserManager::class, 'head_manager_id', 'USERID');
    }

    public function pivot_vice_manager(): HasOne
    {
        return $this->hasOne(UserManager::class, 'vice_manager_id', 'USERID');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'DEFAULTDEPTID', 'DEPTID');
    }
}
