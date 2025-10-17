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
        if ($value && strlen($value) < 60) {
            $this->attributes['password'] = Hash::make($value);
        }
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
