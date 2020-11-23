<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'key',
        'action'
    ];

    public static function validateData($request) {
        return $request->validate([
            'email' => 'required|exists:users,email',
            'action' => 'required'
        ]);
    }
}
