<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sei extends Model
{
    use HasFactory;


    protected $fillable = [
        'spasno',
        'app_id',
        'strand',
        'gender_id',
        'municipality',
        'province',
        'program_id',
        'houseno',
        'street',
        'village',
        'barangay',
        'zipcode',
        'district',
        'region',
        'hsname',
        'lacking',
        'remarks',
        'lname',
        'year',
        'lname',
        'fname',
        'mname',
        'suffix',
        'bday',
        'email',
        'mobile',
        'scholar_status_id',
    ];


    public $timestamps = false;

    //MODIFIED NOV. 23 2023
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }


    public function cog()
    {
        return $this->hasOne(Cog::class, 'scholar_id', 'id');
    }

    // public function province()
    // {
    //     return $this->belongsTo(Provinces::class);
    // }

    // public function municipality()
    // {
    //     return $this->belongsTo(Municipalities::class, 'municipal_id');
    // }

    //MODIFIED NOV. 23 2023
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    //MODIFIED NOV. 23 2023
    // public function scholars()
    // {
    //     return $this->hasMany(Scholars::class, 'spasno', 'spasno');
    // }
}
