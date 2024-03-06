<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define the relationship with the Admin model



//    protected static function boot()
//    {
//        parent::boot();
//
//        static::created(function ($user) {
//            // dd($user->email);
//            if ($user->role === 1) {
//                $admin = new Admin();
//                // Fill the admin table attributes based on the user data.
//                $admin->user_id = $user->id;
//                // Add other attributes as needed.
//                $admin->save();
//            }
//        });
//    }
//
//    public function admin()
//    {
//        return $this->hasOne(Admin::class);
//    }


}
