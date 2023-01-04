<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'signature',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
