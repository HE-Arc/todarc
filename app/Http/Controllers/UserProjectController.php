<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
  * @param  \App\User $user
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, $user)
  {
    if($user != Auth::user()){
      abort(404, 'Invalid rights');
    }

    return parent::store($request, $user);
  }
}
