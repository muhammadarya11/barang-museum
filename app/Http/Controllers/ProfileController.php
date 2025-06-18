<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
public function show()
{
    $user = Auth::user();
    
    $layout = match ($user->role) {
        'pengunjung' => 'layout.app_pengunjung',
        default => 'layout.app', 
    };

    return view('profil', compact('user', 'layout'));
}
}