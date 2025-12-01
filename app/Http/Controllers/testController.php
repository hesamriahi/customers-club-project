<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class testController extends Controller
{
    public function index()
    {
        $user = User::first();
        $user->setScore('login');
        // $user->returnScore('login');
        dd('DONE');
    }
}
