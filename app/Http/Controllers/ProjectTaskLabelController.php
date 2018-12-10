<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Label;
use App\Task;

class ProjectTaskLabelController extends Controller
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
     * @param  \App\Project $project
     * @param  \App\Task $task
     * @param  \App\Label $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task, Label $label)
    {
      $task->labels()->detach($label->id);

      return response()->json(['success' => true], 200);
    }
}
