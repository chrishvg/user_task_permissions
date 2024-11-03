<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->is_admin > 0) {
            $query = Task::orderBy('due_date', 'ASC');
            $permitsAllowed[] = 'is_admin';
        } else {
            $query = Task::where('user_id', Auth::id())->orderBy('due_date', 'ASC');
            $allowedPermissions = $user->permissions->pluck('name');
        }

        $tasks = $query->paginate(5);
        return view('task.index', compact('tasks', 'user','permitsAllowed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $task = Task::findorFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $task->delete();
        return redirect()->route('tasks')->with('success', 'Task deleted successfully.');
    }

    public function markAsDone(Request $request)
    {

        $task = Task::findOrFail($request->task_id);
        $task->done = true;
        $task->save();

        return redirect()->route('tasks')->with('success', 'Mark As Done successfully.');
    }

    public function search(Request $request)
    {
        $term = $request->input('query');
        $completed = $request->input('completed');

        $user = User::findOrFail($request->input('user_id'));

        if ($user->is_admin > 0) {
            $query = Task::orderBy('due_date', 'ASC');
            $permitsAllowed[] = 'is_admin';
        } else {
            $query = Task::where('user_id', $user->id)->orderBy('due_date', 'ASC');
            $allowedPermissions = $user->permissions->pluck('name');
        }

        if ($completed != 'All') {
            $query->where('done', $completed);
        }

        if (trim($term) !== '') {
            $query->where('title', 'like', '%' . $term . '%')
                  ->orWhere('description', 'like', '%' . $term . '%');
        }

        $tasks = $query->paginate(5);

        return view('task.list', compact('tasks', 'user','permitsAllowed'))->render();;
    }


    public function edit(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        return view('task.update', compact('task'));
    }
}
