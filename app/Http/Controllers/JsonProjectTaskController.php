<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class JsonProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        //abort_unless($project->belongsTo(Auth::user()), 404);
        // TODO add verification for rights to see this project

        return response()->json($project->tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        //TODO Create a new Task
        
    }
}
