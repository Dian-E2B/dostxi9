<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email_merit extends Model
{
    use HasFactory;
    protected $table = 'email_merit';
    protected $primaryKey = 'email'; // Assuming 'email' is the primary key
    public $incrementing = false; // Assuming the primary key is not auto-incrementing
}
