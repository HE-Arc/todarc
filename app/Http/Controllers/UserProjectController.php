<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProjectController extends ProjectController
{
  public function __construct()
  {
    parent::__construct();
  }
  
  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, $owner = null)
  {
    $user = Auth::user();

    return parent::store($request, $user);
  }
}
