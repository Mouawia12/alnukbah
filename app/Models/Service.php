<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function subservices()
    {
        return $this->hasMany(\App\Models\Subservice::class);
    }

}
