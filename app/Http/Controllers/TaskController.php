<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;


class TaskController extends Controller
{

    //tasks listing
    public function listTasks()
    {
        $task = new Task();
        $task = $task->get();
        $title = "To Do App";
        return view('to_do_list', ['tasks' => $task, 'title'=>$title]);
    }

    //create task
    public function createTask()
    {
        $task = new Task();
        $task = $task->get();
        $title = "Add Task";
        return view('create_task', ['tasks' => $task, 'title'=>$title]);
    }



    //Store or udpate the task
    public function storeTask(Request $request)
    {
        $request->validate([
             'title' => 'required',
             'description' => 'required',
        ]);

        $task = new Task();
        $id = $request->id;

        $task->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'description' => $request->description,
                'title' => $request->title,
                'created_by' => Auth::user()->id,
            ]
        );
        return redirect()->back()->with('message', 'Task Submitted Successfully');
        // return redirect('to-do-list');
    }

    //Edit task
    public function editTask($id)
    {
        $task = Task::find($id);
          $title = "Edit Task";
        return view('edit_task', ['task' => $task,'title'=>$title]);
    }

    //Delete task
    public function destroy($id)
    {
        $task = Task::find($id);
        $taskDeleted = $task->delete();
        if ($taskDeleted) {
            return redirect('to-do-list');
        }
    }
}