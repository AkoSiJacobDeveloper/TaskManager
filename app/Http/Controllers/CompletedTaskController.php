<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CompletedTaskController extends Controller
{
    public function delete($task) {

        $task = Task::findOrFail($task); // Single model instance
        $task->delete();

        return redirect()->route('completed')->with('success', 'Deleted Successfully.');
    }
}
