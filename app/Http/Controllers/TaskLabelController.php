<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Label;
use App\Task;

class TaskLabelController extends Controller
{
    public function destroy(Project $project, Task $task, Label $label)
    {

    }
}
