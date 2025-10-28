<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subservice extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'images',
        'setnumberonimage',
    ];

    protected $casts = [
        'images' => 'array',
        'setnumberonimage' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }   
}
