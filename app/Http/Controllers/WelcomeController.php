<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $user = Auth::user();
        return view('admin.welcome', ['user' => $user]);
    }
}
