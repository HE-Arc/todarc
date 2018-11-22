<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class JsonGroupController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO destroy a group
    }
}
