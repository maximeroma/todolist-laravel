<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\ListTask;
use Validator;

class TaskController extends Controller
{
    public function store (Request $request) {
      $validator = Validator::make($request->all(), [
        'task' => 'required|max:255'
      ]);

      if ($validator->fails()) {
        return redirect ('/task')->withErrors($validator, 'task')->withInput();
      }

      $task = new Task;
      $task->name = $request->input('task');
      $task->fk_list = $request->select;
      $task->save();
      return redirect('/task');
    }

    public function show () {
      $task = Task::all();
      $list = ListTask::all();
      return view('task', ['tasks' => $task, 'lists' => $list ]);
    }

    public function delete ($id) {
      Task::findOrFail($id)->delete();
      return redirect('/task');
    }

    public function update (Request $request, $id) {
      $task = Task::find($id);
      $task->state = !$request->input('state');
      $task->save();

      return redirect('/task');
    }
}
