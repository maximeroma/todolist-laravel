<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTask;
use App\Task;
use Validator;

class ListTaskController extends Controller
{
  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'list' => 'required|max:255'
    ]);

    if ($validator->fails()) {
      return redirect ('/task')->withErrors($validator, 'list')->withInput();
    }

    $list = new ListTask;
    $list->name = $request->input('list');
    $list->save();
    return redirect('/task');
  }

  public function show ($id) {
    $list = ListTask::all();
    $task = Task::where('fk_list', $id)->get();
    return view('task', ['lists' => $list, 'tasks' => $task]);
  }

  public function delete($id){
    ListTask::findOrFail($id)->delete();
    return redirect('/task');
  }
}
