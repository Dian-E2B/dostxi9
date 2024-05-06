<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholar_requirements extends Model
{
    use HasFactory;

    protected $fillable = [
        "scholarshipagreement",
        "informationsheet",
        "scholaroath",
        "prospectus",
        "prospectus",
        "cor_first",
        "accnumber",
        "scholar_id",

    ];

    public $timestamps = false;
}
