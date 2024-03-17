<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function index() {
      return view("login");
    }

    public function login() {
      validator(request()->all(), [
          'email' => ['required', 'min:4', 'max:255', 'email'],
          'password' => ['required', 'min:8', 'max:255']
      ])->validate();

      if(auth()->attempt(request()->only(['email', 'password']))) {
          return to_route('home.index');
      } else {
          return back();
      }
    }

    public function logout() {
      auth()->logout();

      return to_route('home.index');
    }
}
