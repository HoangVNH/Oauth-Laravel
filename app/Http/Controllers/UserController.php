<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {

        $users = User::all();

        return view('dashboard', ['users' => $users]);
    }

    public function create(Request $request) {

        $authUser = User::where('email', $request->input('email'))->first();

        if($authUser) {
            return redirect('/users')->with('failed', 'An account with ' . $request->input('email') . ' is already exists!');
        }

        $validatedUser = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'string', 'min:8'],
        ]);

        $newUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Mail::to($newUser)->send(new WelcomeEmail($newUser));

        return back()->with('success', 'Created new user successfully!');
    }

    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $validatedUser = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255'],
            'password' => ['bail', 'required', 'string', 'min:8'],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return back()->with('success', 'Updated user successfully! ');
    }

    public function destroy($id) {

        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success', 'Deleted user successfully! ');
    }
}
