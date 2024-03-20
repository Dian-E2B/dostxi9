<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification_staffs extends Model
{
    use HasFactory;

    protected $fillable = [
        'scholar_id',
        'type',
        'message',
        'data_id',
    ];
}
