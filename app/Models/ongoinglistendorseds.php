<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ongoinglistendorseds extends Model
{
    use HasFactory;

    protected $fillable = [
        'scholar_id',
        'name',
        'school',
        'course',
        'semester',
        'year',
    ];
}
