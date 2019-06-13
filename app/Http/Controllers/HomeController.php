<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Search;

class HomeController extends Controller
{
  public function welcome()
  {
    $viewData = $this->loadViewData();

    $searches = Search::all();

    return view('welcome', $viewData)->with('searches', $searches);
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