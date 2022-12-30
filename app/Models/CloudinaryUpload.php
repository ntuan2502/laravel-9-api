<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudinaryUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'getPath',
        'getSecurePath',
        'getSize',
        'getReadableSize',
        'getFileType',
        'getFileName',
        'getOriginalFileName',
        'getPublicId',
        'getExtension',
        'getWidth',
        'getHeight',
    ];
}
