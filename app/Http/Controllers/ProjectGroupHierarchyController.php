<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class ProjectGroupHierarchyController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('checkowner');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Integer $project_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        $ids = array_map(function($g){return $g['id'];}, $request->groups);
        $groups = Group::where('project_id',$project_id)->whereIn('id', $ids)->get();
        
        foreach($groups as $group){
            $id = $group->id;
            foreach ($request->groups as $groupFrontEnd) {
                if($groupFrontEnd['id'] == $id){
                    $group->order = $groupFrontEnd['order'];
                    $group->group_id = $groupFrontEnd['group_id'];
                    $group->save();
                }
            }
        }

        return response('Creation Successfull', 200);
    }
}
