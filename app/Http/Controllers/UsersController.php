<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 

class UsersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('home', ['user' => $user]);
    }
}
