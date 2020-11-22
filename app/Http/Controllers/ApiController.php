<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function index()
    {
        return view('api.index');
    }

    public function show(Request $request)
    {
        if ($request->id) {
            return response()->json([
                'status' => 'success',
                'message' => 'Get single data user.',
                'data' => User::where('id', $request->id)->first()
            ], 200);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Get all data user.',
                'data' => User::all()
            ], 200);
        }
    }
}
