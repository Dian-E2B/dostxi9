<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;
    protected $table = 'thesis';

    protected $fillable = [
        'scholar_id',
        'thesis_details',
        'thesis_status',
        'thesis_remarks',
        'updated_at',
        'created_at'
    ];
}
