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

    public static function foundKey($request) {
        return self::where('key', $request->key)->count() !== 0;
    }

    public static function actionKey($request, $action) {
        return self::where('key', $request->key)->where('action', 'like', '%' . $action . '%')->count() !== 0;
    }

    public static function requiredKey() {
        return response()->json([
            'status' => 'failed',
            'message' => 'Need key to access api service.',
        ], 400);
    }
    
    public static function requiredKeyId() {
        return response()->json([
            'status' => 'failed',
            'message' => 'Need key and id to access api service.',
        ], 400);
    }

    public static function invalidKey() {
        return response()->json([
            'status' => 'failed',
            'message' => 'Key not found.',
        ], 400);
    }

    public static function blockAction() {
        return response()->json([
            'status' => 'failed',
            'message' => 'Action not allowed.',
        ], 403);
    }
    
    public static function failedAction() {
        return response()->json([
            'status' => 'failed',
            'message' => 'The action cannot be continued, please check your data again.',
        ], 403);
    }
}
