<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Group;

class JsonTaskController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|max:255',
            'group_id' => 'required|integer',
            'from_date' => 'nullable|date',
            'until_date' => 'nullable|date',
            'order' => 'integer',
            'done' => 'boolean'
        ]);
        
        Group::where('project_id',$task->group->project_id)->findOrFail($request->input('group_id'));
        
        $task->update(request([
            'name',
            'group_id',
            'from_date',
            'until_date',
            'order',
            'done',
        ]));

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO destroy a group
    }
}
