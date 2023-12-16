<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\Task; 

class TaskManagementController extends Controller
{
    // display list of task and search functionality
    public function taskList(Request $request){
        $search = $request->input('search');
        
        $tasks = Task::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate(5);
    
        return view('index', compact('tasks'));
    }

    //  create task view page
    public function createTaskView(){
        return view('create-task');
    }

    // add task in the list
    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,completed',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return redirect()->route('task.list')->with('success', 'Task added successfully');
    }


    // edit or update task view page
    public function editTaskView(Task $task){
        return view('edit-task', compact('task'));
    }
    

    // edit or update task 
    public function updateTask(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($validatedData);
        return redirect()->route('task.list')->with('success', 'Task updated successfully');
    }

    // task detail view page
    public function showTask(Task $task)
    {
        return view('task-details', compact('task'));
    }

    // delete task from the task list to trash/bin
    public function deleteTask($task)
    {
        $task = Task::find($task);

        if ($task) {
            $task->delete();
            return redirect()->route('task.list')->with('success', 'Task moved to bin.');
        } else {
            return redirect()->route('bin.task')->with('error', 'Task not found.');
        }
    }

    // display list of deleted task and search functionality
    public function binTask(Request $request)
    {
        $search = $request->input('search');

        $deletedTasks = Task::onlyTrashed()->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        })->orderBy('deleted_at', 'desc')->paginate(5);

        return view('bin-page', compact('deletedTasks'));
    }

    // Restore task from bin to task list
    public function restoreTask($task)
    {
        $task = Task::withTrashed()->find($task);

        if ($task) {
            $task->restore();
            return redirect()->route('bin.task')->with('success', 'Task restored.');
        } else {
            return redirect()->route('task.list')->with('error', 'Task not found in the bin.');
        }
    }

    // Delete task permanently
    public function destroy($task)
    {
        $taskInstance = Task::onlyTrashed()->find($task);
        $taskInstance->forceDelete();
        return redirect()->route('bin.task')->with('success', 'Task permanently deleted successfully');
       
    }
}
