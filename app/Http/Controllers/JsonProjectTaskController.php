<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

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
        $request->validate([
            'name' => 'required|max:255',
            'group_id' => 'required|integer',
            'from_date' => 'nullable|date',
            'until_date' => 'nullable|date',
            'description' => 'nullable|max:1000',
            'order' => 'integer',
            'done' => 'boolean'
        ]);

        $project->groups()->findOrFail($request->input('group_id'));

        $task = $project->tasks()->create(request([
            'name',
            'group_id',
            'from_date',
            'until_date',
            'description',
            'order',
            'done',
        ]));

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, $id)
    {
      $task = Task::find($id);
      $task->delete();

      return response()->json(['message' => 'Task deleted successfully!'], 200);
    }
}
