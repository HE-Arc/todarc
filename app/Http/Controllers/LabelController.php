<?php

namespace App\Http\Controllers;

use App\Label;
use App\Project;
use Illuminate\Http\Request;

class LabelController extends Controller
{
  public function __construct()
  {
     $this->middleware('checkowner');
  }

  public function index(Project $project)
  {
    return $project->labels->toJson();
  }

  public function destroy(Project $project, Label $label)
  {
    $label->delete();

    return response()->json(['success' => true, 'labels' => $project->labels], 200);
  }

  public function update(Request $request, Project $project, Label $label)
  {
    $label->name = $request->name;
    $label->color = $request->color;
    $label->save();

    return response()->json(['success' => true, 'labels' => $project->labels], 200);
  }

  public function store(Request $request, Project $project)
  {
    $label = new Label;
    $label->project()->associate($project);
    $label->name = $request->name;
    $label->color = $request->color;
    $label->save();

    return response()->json(['success' => true, 'labels' => $project->labels], 201);
  }
}
