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

        return response()->json($project->groups);
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
        // TODO Add a new Group
        $ids = array_map(function($g){return $g['id'];}, $request->groups);
        $groups = Group::whereIn('id', $ids)->get();
        
        $consumed = [];
        $bool = true;
        
        foreach($groups as $group){
            $id = $group->id;
            foreach ($request->groups as $groupFrontEnd) {
                if($groupFrontEnd['id'] == $id){
                    array_push($consumed,$id);
                    $group->order = $groupFrontEnd['order'];
                    $group->group_id = $groupFrontEnd['group_id'];
                    $group->save();
                }
            }
        }

        return response('Creation Successfull'+dd($consumed), 200);
    }

    /**
     * Update groups order and of a project
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $ids = array_map(function($g){return $g['id'];}, $request->groups);
        $groups = Group::whereIn('id', $ids);

        foreach($groups as $group){
            $id = $group->id;
            foreach ($request->groups as $groupFrontEnd) {
                if($groupFrontEnd['id'] == $id){
                    $group->update(['order' => $groupFrontEnd['order'], 'group_id' => $groupFrontEnd['group_id']]);
                }
            }
        }

        //TODO update group hierarchie and order
        return response('Update Successfull', 200);
    }
}
