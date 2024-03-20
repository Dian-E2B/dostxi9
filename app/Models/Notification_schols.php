<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification_schols extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'message',
        'data_id',
        'scholar_id',
    ];
}
