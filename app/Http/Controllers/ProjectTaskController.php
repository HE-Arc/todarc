<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Group;
use App\Task;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
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

        foreach ($request->input("labels") as $label) {
            $task->labels()->attach($label["id"]);
        }

        $users = $request->input("users");

        if($users)
        {
          foreach ($users as $user)
          {
            $task->users()->attach($user);
          }
        }

        $task = Task::with('labels')->find($task->id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
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

        Group::where('project_id',$task->group->project_id)->findOrFail($request->input('group_id'));

        $task->update(request([
            'name',
            'group_id',
            'from_date',
            'until_date',
            'description',
            'order',
            'done',
        ]));

        $task->labels()->detach();
        foreach ($request->input("labels") as $label) {
            $task->labels()->attach($label["id"]);
        }

        $users = $request->input("users");

        if($users)
        {
          $task->users()->detach();
          foreach ($users as $user)
          {
            $task->users()->attach($user["id"]);
          }
        }

        $task = Task::with(['labels', 'users'])->find($task->id);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->users()->detach();
        $task->labels()->detach();
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully!'], 200);
    }
}
