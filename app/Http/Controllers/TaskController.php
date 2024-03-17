<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Models\User;

class TaskController extends Controller
{
    public function create() {

      $status = validator()->make(request()->all(), [
          'task_title' => ['required', 'min:4', 'max:255'],
          'task_content' => ['required', 'min:4', 'max:255'],
          'hashtag' => ['required', 'min:3', 'max:255'],
          'deadline_date' => ['required'],
      ]);

      if($status->fails() == false) {

        $new_task = new Task;

        $new_task->user_id = auth()->user()->id;

        $new_task->task_title = request()->all()['task_title'];

        $new_task->task_content = request()->all()['task_content'];

        $new_task->hashtag = request()->all()['hashtag'];

        if(isset(request()->all()['finished']) == false) {
          $new_task->finished = 0;
          
        } else if(isset(request()->all()['finished']) == true) {
          $new_task->finished = 1;
        }

        $new_task->finished_date = date('Y:m'); // still not finished yet!

        $new_task->deadline_date = request()->all()['deadline_date'];

        $new_task->save();

        return to_route('home.index');
      } else {
        return back()->withErrors(['error' => "Invalid Fields"]);
      }
    }

    public function finish($task_id) {
      // finish the task id.
      $new_finished_task = Task::find($task_id);
      $new_finished_task->finished = true;
      $new_finished_task->finished_date = date('Y:m:d H:m:s');
      $new_finished_task->save();
      return to_route('home.index');
    }

    public function delete($task_id) {
      $deleted_task = Task::find($task_id)->delete();
      return to_route('home.index');
    }
}
