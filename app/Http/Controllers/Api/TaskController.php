<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Get all tasks for logged-in user
    public function index()
    {
        return auth()->user()->tasks()->orderBy('id', 'desc')->get();
    }

    // Store new task for logged-in user
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string',
        'due_at' => 'nullable|date',
    ]);

    return auth()->user()->tasks()->create([
        'title' => $request->title,
        'due_at' => $request->due_at,
    ]);
    }

    // Toggle completed (no need for manual user check)
    public function update(Request $request, $id)
    {
    $request->validate([
        'title' => 'required|string',
        'due_at' => 'nullable|date',
    ]);

    $task = Task::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $task->update([
        'title' => $request->title,
        'due_at' => $request->due_at,
    ]);

    return response()->json([
        'message' => 'Task updated successfully',
        'task' => $task
    ]);
    }

    public function destroy($id)
    {
    $task = auth()->user()->tasks()->findOrFail($id);
    $task->delete();

    return response()->json(['message' => 'Deleted']);
    }

    public function show($id)
    {
    return auth()->user()
        ->tasks()
        ->findOrFail($id);
    }

}
