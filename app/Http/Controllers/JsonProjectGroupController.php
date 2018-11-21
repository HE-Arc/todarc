<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Group;

class JsonProjectGroupController extends Controller
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

        return response()->json($project->groups->first());
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
        $request->validate([
            'name' => 'required|max:255',
            'group_id' => 'nullable|integer',
            'order' => 'integer',
            'project_id' => 'required|integer'
        ]);
        
        if($request->input('project_id') != $project->id){
            abort(403, 'Unauthorized action.');
        }

        if($request->input('group_id') != Null){
            $project->groups()->findOrFail($request->input('group_id'));
        }
        
        $group = $project->groups()->create(request([
            'name',
            'group_id',
            'order',
        ]));
        
        return response()->json([
            'id' => $group->id,
            'name' => $group->name,
            'group_id' => $group->group_id,
            'order' => $group->order,
            'all' => $request->all()
        ]);

        return response()->json($group);
    }
}
