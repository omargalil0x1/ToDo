<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorHandler extends Controller
{
    public function handler() {
      return view('error-404');
    }
}
