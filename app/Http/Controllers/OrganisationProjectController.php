<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Organisation;
use App\User;

class OrganisationProjectController extends ProjectController
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
    public function store(Request $request, $ownerId)
    {
        $organisation = Organisation::find($ownerId);

        $organisation->users()->findOrFail(Auth::user()->id);

        return parent::store($request, $organisation);
    }
}
