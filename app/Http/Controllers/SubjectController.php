<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    // GET ALL SUBJECT
    public function index(Request $request)
    {
        return Subject::where('user_id', $request->user()->id)->get();
    }

    // CREATE SUBJECT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $subject
        ]);
    }

    // UPDATE SUBJECT
    public function update(Request $request, $id)
    {
        $subject = Subject::where('user_id', $request->user()->id)->findOrFail($id);

        $subject->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $subject
        ]);
    }

    // DELETE SUBJECT
    public function destroy(Request $request, $id)
    {
        $subject = Subject::where('user_id', $request->user()->id)->findOrFail($id);
        $subject->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted'
        ]);
    }
}