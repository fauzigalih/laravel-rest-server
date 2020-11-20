<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    public static function validateData(Request $request) {
        $store = Route::currentRouteName() === 'store';
        return $request->validate(array_merge([
            'name' => 'required', 
            'email' => 'required',
            'phone' => 'required'
        ], $store ? ['email' => 'required|unique:users,email'] : []));
    }
}
