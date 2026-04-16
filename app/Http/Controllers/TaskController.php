<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // GET ALL TASK
    public function index(Request $request)
    {
        return Task::where('user_id', $request->user()->id)
            ->with('subject')
            ->get();
    }

    // CREATE TASK
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required|date',
            'subject_id' => 'required'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => 'pending',
            'user_id' => $request->user()->id,
            'subject_id' => $request->subject_id
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $task
        ]);
    }

    // UPDATE TASK
    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', $request->user()->id)->findOrFail($id);

        $task->update($request->only([
            'title',
            'description',
            'deadline',
            'status',
            'subject_id'
        ]));

        return response()->json([
            'status' => 'success',
            'data' => $task
        ]);
    }

    // DELETE TASK
    public function destroy(Request $request, $id)
    {
        $task = Task::where('user_id', $request->user()->id)->findOrFail($id);
        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted'
        ]);
    }
}