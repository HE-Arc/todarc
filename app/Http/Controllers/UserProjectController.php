<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserProjectController extends ProjectController
{
  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  Integer $ownerId
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, $ownerId)
  {
    $user = Auth::user();
    if($ownerId != $user->id){
      abort(404, 'Invalid rights '.$ownerId);
    }

    return parent::store($request, $user);
  }
}
