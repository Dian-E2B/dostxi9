<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Scholars extends Model
{
    use HasFactory;

    protected $fillable = [
        'spasno',
        'orientation_id',
        'lname',
        'fname',
        'mname',
        'suffix',
        'bday',
        'email',
        'mobile',
        'status_id',
        'user_id',
    ];

    public $timestamps = false;

    public function sei()
    {
        return $this->belongsTo(Sei::class, 'spasno', 'spasno');
    }
    public function replyslips()
    {
        return $this->hasMany(replyslips::class);
    }


// Define the relationship with the User student.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
