<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Api;

class ApiController extends Controller
{
    public function index()
    {
        return view('api.index');
    }

    public function generate(Request $request) {
        Api::validateData($request);
        $generate = Api::create([
            'email' => $request->email,
            'key' => Str::random(20),
            'action' => implode(',', $request->action)
        ]);
        if ($generate) {
            return redirect('api')->with('success', 'Data created successfully! <br>
                                        Key: '. Str::random(20));
        }else{
            return redirect('api')->with('danger', 'Data failed to generate!');
        }
    }

    public static function validateKeyApi($request) {
        if (!$request->key) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Need key to access api service.',
            ], 400);
        }else{
            $key = Api::where('key', $request->key)->count();
            if ($key === 0) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Key not found.',
                ], 400);
            }else{
                if (Api::where('key', $request->key)->where('action', 'like', '%' . 'read' . '%')->count() === 0) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Action not allowed.',
                    ], 403);
                }
            }
        }
    }

    public function show(Request $request)
    {
        if (!$request->key) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Need key to access api service.',
            ], 400);
        }else{
            $key = Api::where('key', $request->key)->count();
            if ($key === 0) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Key not found.',
                ], 400);
            }else{
                if (Api::where('key', $request->key)->where('action', 'like', '%' . 'read' . '%')->count() === 0) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Action not allowed.',
                    ], 403);
                }
            }
        }

        $model = Api::where('key', $request->key)->first();
        if ($request->id) {
            return response()->json([
                'status' => 'success',
                'to' => $model->email ?? null,
                'message' => 'Get single data user.',
                'data' => User::where('id', $request->id)->first()
            ], 200);
        }else{
            return response()->json([
                'status' => 'success',
                'to' => $model->email ?? null,
                'message' => 'Get all data user.',
                'data' => User::all()
            ], 200);
        }
    }
}
