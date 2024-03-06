<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestdocs extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'scholar_id',
        'document_details',
        'document_type',
        'date_uploaded',
    ];
}
