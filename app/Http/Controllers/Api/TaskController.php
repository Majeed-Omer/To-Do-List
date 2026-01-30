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
        return auth()->user()->tasks()->orderBy('created_at', 'desc')->get([
            'id',
            'title',
            'due_at',
        ]);
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

    $task = auth()->user()
        ->tasks()
        ->where('id', $id)
        ->firstOrFail();

    $task->update([
        'title' => $request->title,
        'due_at' => $request->due_at,
    ]);

    return response()->json([
        'success' => true,
        'task' => $task,
    ]);
}


    public function destroy($id)
{
    $task = auth()->user()->tasks()->findOrFail($id);
    $task->delete(); // PERMANENT delete

    return response()->json([
        'message' => 'Task permanently deleted'
    ], 200);
}


    public function show($id)
    {
    return auth()->user()
        ->tasks()
        ->findOrFail($id);
    }

}
