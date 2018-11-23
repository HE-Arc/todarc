<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Group;
use View;


class ProjectController extends Controller
{

    public function __construct()
    {
       $this->middleware('checkowner');
    }

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
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Organisation or \App\User $owner
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, $owner)
    {
        $project = new Project;

        $project->name = $request->projectName;
        $project->owner()->associate($owner);
        $project->save();

        //Add a default group
        $group = new Group;
        $group->name = self::DEFAULT_GROUPNAME;
        $group->project()->associate($project);
        $group->order = 0;
        $group->save();

        $redirectTo = action('ProjectController@show', ['id' => $project->id]);

        return response()->json(['success' => true, 'redirectTo' => $redirectTo], 201);
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
        return View::make('project.dashboard', ['groups'=>$project->groups, 'tasks'=>$project->tasks, 'labels' => $project->labels])->with('project', $project);
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
