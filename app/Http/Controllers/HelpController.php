<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('help.index');
    }
}
