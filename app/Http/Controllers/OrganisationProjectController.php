<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Organisation;
use App\User;

class OrganisationProjectController extends ProjectController
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, $ownerId)
    {
        $organisation = Organisation::find($ownerId);

        return parent::store($request, $organisation);
    }
}
