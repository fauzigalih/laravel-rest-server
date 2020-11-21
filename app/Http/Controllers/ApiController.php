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

    public function show()
    {
        return response()->json(User::all(), 200);
    }
}
