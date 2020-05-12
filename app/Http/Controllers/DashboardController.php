<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index() {

        $users = User::all();

        return view('dashboard', ['users' => $users]);
    }

    public function findOrCreate(Request $request) {

        $authUser = User::where('email', $request->input('email'))->first();

        if($authUser) {
            return redirect('/dashboard')->with('failed', 'User is already registered !');
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('/dashboard')->with('success', 'Created new user successfully!');
    }

}
