<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTaskHierarchyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        //TODO check rights for this project
        $ids = array_map(function($g){return $g['id'];}, $request->tasks);
        $tasks = $project->tasks()->whereIn('tasks.id', $ids)->get();
        
        foreach($tasks as $task){
            $id = $task->id;
            foreach ($request->tasks as $taskFrontEnd) {
                if($taskFrontEnd['id'] == $id){
                    $task->order = $taskFrontEnd['order'];
                    $task->group_id = $taskFrontEnd['group_id'];
                    $task->save();
                }
            }
        }

        return response('Creation Successfull', 200);
    }
}
