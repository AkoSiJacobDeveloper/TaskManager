<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index() {
        return Inertia::render('UserDashboard', [
            'taskStats' => [
                'total' => Task::count(),
                'pending' => Task::where('status', 'Pending')->count(),
                'completed' => Task::where('status', 'Completed')->count()
            ]
        ]);
    }
}
