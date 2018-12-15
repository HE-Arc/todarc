<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

          $redirectTo = action('OrganisationController@show', ['id' => $organisation->id]);

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

        $projects = $organisation->projects;
        $users = $organisation->users;

        return view('organisationDashboard.dashboard', ['user' => $user,
                                                        'organisation' => $organisation,
                                                        'projects' => $projects,
                                                        'users' => $users
                                                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
