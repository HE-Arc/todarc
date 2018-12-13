<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $organisation->save();
        $organisation->Users()->attach([Auth::user()->id]);

        $redirectTo = action('OrganisationController@show', ['id' => $organisation->id]);

        return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
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
}
