<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganisationProjectController extends ProjectController
{
  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, $owner = null)
  {
    //TODO change this to add to a real Organisation
    $organisation = null;

    return parent::store($request, $organisation);
  }
}
