<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        $userIdModules = Auth::user()->modules->select('id')->toArray();

        $questions = Question::whereDoesntHave('answer')
            ->whereIn('module_id', $userIdModules)
            ->orderBy('created_at')
            ->get();

        return view('dashboard', compact('questions'));
    }
}
