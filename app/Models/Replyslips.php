<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Replyslips extends Model
{
    use HasFactory;

    protected $fillable = [
        'scholar_id',
        'signature',
        'signatureparents',
        'replyslip_status_id',
        'updated_at',
        // Add other fillable attributes here if needed
    ];

    //protected $dates = ['created_at', 'updated_at'];
}
