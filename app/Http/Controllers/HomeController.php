<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Models\User;

class HomeController extends Controller
{
    public function index() {
      return view('home', [
        'unfinished_tasks' => User::find(auth()->user()->id)->tasks()->where('finished', 0)->get(),
        'finished_tasks' => User::find(auth()->user()->id)->tasks()->where('finished', 1)->get(),
      ]);
    }
}
