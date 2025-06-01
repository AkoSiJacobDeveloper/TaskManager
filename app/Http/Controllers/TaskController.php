<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Pending', [
            'tasks' => $request->user()->tasks()->where('status', 'Pending')->latest()->get(),
        ]);
    }

    public function completed(Request $request)
    {
        return Inertia::render('Completed', [
            'tasks' => $request->user()->tasks()->where('status', 'Completed')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Pending,Completed',
            'due_date' => 'required|date',
        ]);

        if ($validated['status'] === 'Completed') {
            $validated['completed_at'] = now();
        }

        $request->user()->tasks()->create($validated);

        return redirect()->route('pending')->with('success', 'Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Tasks/Edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Pending,Completed',
            'due_date' => 'required|date',
            'completed_at' => 'nullable|date',
        ]);

        // If the task is being marked as completed and doesn't have a completed_at date
        if ($validated['status'] === 'Completed' && !$task->completed_at) {
            $validated['completed_at'] = now();
        }

        // Update the task
        $task->update($validated);

        // Redirect based on the new status
        if ($validated['status'] === 'Completed') {
            return redirect()->route('pending')->with('success', 'Task Completed');
        }

        return redirect()->route('pending')->with('success', 'Editted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $status = $task->status;
        $task->delete();

        if ($status === 'Completed') {
            return redirect()->route('completed')->with('success', 'Deleted Successfully.');
        }

        return redirect()->route('pending')->with('success', 'Deleted Successfully.');
    }
}
