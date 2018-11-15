<?php

namespace App\Http\Controllers;

use App\Project;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $projects = Project::all();
        // TODO filter with user

        // load the view and pass the projects
        return view('home')->with('projects', $projects);
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
        $project = new Project;

        $project->name = $request->projectName;
        $project->owner()->associate(Auth::user());
        $project->save();

        $group = new Group;
        $group->name = self::DEFAULT_GROUPNAME;
        $group->project()->associate($project);
        $group->save();

        $redirectTo = '/';

        return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeForOrganisation(Request $request, $orgName)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // show the view and pass the project to it
        //$groups = $project->groups();
        return View::make('project.dashboard', ['groups'=>$project->groups])->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    const DEFAULT_GROUPNAME = 'Todo';
}
