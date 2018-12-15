<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class OrganisationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organisation = new Organisation;
        $organisation->name = $request->orgName;

        try
        {
          $organisation->save();
          $organisation->Users()->attach([Auth::user()->id]);

          $redirectTo = action('OrganisationController@show', ['name' => $organisation->name]);

          return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
        }
        catch(QueryException $e)
        {
          return response()->json(['success' => false], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \String  $organisationName
     * @return \Illuminate\Http\Response
     */
    public function show($organisationName)
    {
        $user = Auth::user();
        $organisation = Organisation::where('name', $organisationName)->first();

        if($organisation)
        {
          $projects = $organisation->projects;
          $users = $organisation->users;

          return view('organisationDashboard.dashboard', ['user' => $user,
              'organisation' => $organisation,
              'projects' => $projects,
              'users' => $users
          ]);
        }
        else
        {
          abort(404);
        }
    }
}
