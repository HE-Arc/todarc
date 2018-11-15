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
    $organisation = null;

    return parent::store($request, $organisation);
  }
}
