<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Enrollment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $enrollments = Enrollment::where('user_id', $user->id)->with('subject')->get();
            return view('student.home', compact('enrollments'));
        } elseif ($user->role === 'professor') {
            $subjects = Subject::where('professor_id', $user->id)->get();
            return view('professor.home', compact('subjects'));
        }

        return view('home');
    }
}
