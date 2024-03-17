<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
      return view('register');
    }

    public function register() {
      $status = validator()->make(request()->all(), [
          'name' => ['required'],
          'email' => ['required', 'email'],
          'password' => ['required', 'confirmed'],
      ]);

      if($status->fails()) {
        return back()->withErrors(['error' => 'Invalid/Empty Fields']);
      } else {
        try {
          auth()->logout();
        }

        $new_user = new User;
        $new_user->name = request()->all()['name'];
        $new_user->email = request()->all()['email'];
        $new_user->password = Hash::make(request()->all()['password']);
        $new_user->save();


        auth()->attempt(request()->only(['email', 'password']));

        return to_route('home.index');
      }
    }
}
