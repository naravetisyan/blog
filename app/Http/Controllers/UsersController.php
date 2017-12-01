<?php
namespace App\Http\Controllers;

use Auth; 

class UsersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('home', ['user' => $user]);
    }
}
