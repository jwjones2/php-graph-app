<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function welcome()
  {
    $viewData = $this->loadViewData();

    return view('welcome', $viewData);
  }

  public function test1(){
    session(['color' => 'YELLOW']);
    return view ('testing');
  }

  public function test2(){
    $val = session('color');
    return view ('testing_still')->with('value', $val);
  }
}