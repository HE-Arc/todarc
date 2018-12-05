<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Group;

class ProjectGroupController extends Controller
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
        
        return response()->json($group);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|max:255',
            'group_id' => 'nullable|integer',
            'order' => 'integer',
        ]);
        
        if($request->input('group_id') != Null){
            Group::where('project_id',$group->project_id)->findOrFail($request->input('group_id'));

            if($request->input('group_id') == $group->id){
                abort(403, 'Unauthorized action. Self referencing group');
            }
        }
        
        $group->update(request([
            'name',
            'group_id',
            'order',
        ]));
        
        return response()->json($group);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Group $group)
    {
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully!'], 200);
    }
}
