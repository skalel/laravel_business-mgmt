<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalController extends Controller
{
  public function approval()
  {
    return view('auth.approval');
  }
}
