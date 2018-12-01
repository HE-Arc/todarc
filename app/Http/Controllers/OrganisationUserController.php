<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Organisation;
use App\User;

class OrganisationUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Organisation $organisation)
    {
        // Vérification des droits
        if(! $organisation->users()->where('users.id', '=', Auth::user()->id)->exists()) {
            abort(403, 'Access denied');
        }

        $organisation->users()->attach($request->input("id"));

        $redirectTo = action('OrganisationController@show', ['organisationName' => $organisation->name]);
        return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Organisation $organisation
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organisation $organisation, $userId)
    {
      $organisation->users()->detach($userId);

      $redirectTo = action('OrganisationController@show', ['organisationName' => $organisation->name]);

      return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
    }
}
