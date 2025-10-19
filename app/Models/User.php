<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'settings',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array',
    ];

    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['password'] = $this->needsHashing($value)
            ? Hash::make($value)
            : $value;
    }

    protected function needsHashing(string $value): bool
    {
        if (strlen($value) !== 60) {
            return true;
        }

        return !str_starts_with($value, '$2y$') && !str_starts_with($value, '$argon2');
    }

    // علاقة belongsTo بين المستخدم والأدوار
        public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }



    public function getMainRoleAttribute()
{
    // نحاول نحمّل العلاقة إذا مش محمّلة
    if (!$this->relationLoaded('roles')) {
        $this->load('roles');
    }

    return optional($this->roles->first())->name ?? 'بدون دور';
}


}
