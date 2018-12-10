<?php

namespace App\Http\Controllers;

use App\Label;
use App\Project;
use Illuminate\Http\Request;

class ProjectLabelController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('checkowner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
       return $project->labels->toJson();
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
        $label = new Label;
        $label->project()->associate($project);
        $label->name = $request->name;
        $label->color = $request->color;
        $label->save();

        return response()->json($label, 201);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project $project
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Label $label)
    {
        $label->name = $request->name;
        $label->color = $request->color;
        $label->save();

        return response()->json($label, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Label $label)
    {
        $label->delete();

        return response()->json(['success' => true], 200);
    }
}
