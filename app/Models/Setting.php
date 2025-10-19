<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'display_name', 'value', 'details', 'type', 'order', 'group'
    ];

    public $timestamps = false;

    // 🔧 لتحميل الصور بسهولة
    public function isImage()
    {
        return $this->type === 'image';
    }
}
