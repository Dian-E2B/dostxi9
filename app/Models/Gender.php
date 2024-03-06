<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Allow  assignment for the 'name' column

    // Disable 'Gender' table timestamps
    public $timestamps = false;

    // Relationships, custom methods, and other model logic can be added here
    public function sei()
    {
        return $this->hasMany(Sei::class);
    }
}
