<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cogdetails extends Model
{
    use HasFactory;

    protected $fillable = ['subjectname', 'grade', 'unit', 'completed'];
    public $timestamps = false;

    public function cog()
    {
        return $this->belongsTo(Cog::class);
    }
}
