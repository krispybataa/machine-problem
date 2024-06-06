<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    public function home()
    {
        $subjects = Subject::all(); // Or any other logic to fetch data
        return view('professor.home', compact('subjects'));
    }
    public function index()
    {
        $user = Auth::user();
        $subjects = Subject::where('professor_id', $user->id)->get();
        return view('professor.home', compact('subjects'));
    }

    public function addSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'available_slots' => 'required|integer|min:1',
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->available_slots = $request->available_slots;
        $subject->professor_id = Auth::user()->id; // Set the professor ID
        $subject->save();

        return redirect()->route('professor.home')->with('success', 'Subject added successfully!');
    }



    public function removeSubject($id)
    {
        $subject = Subject::find($id);

        if ($subject && $subject->professor_id == Auth::id()) {
            $subject->delete();
            return redirect()->route('professor.home')->with('success', 'Subject removed successfully!');
        }

        return redirect()->route('professor.home')->with('error', 'You are not authorized to remove this subject.');
    }

    public function subjects()
    {
        $user = Auth::user();
        $subjects = Subject::where('professor_id', $user->id)->get();
        return view('professor.subjects', compact('subjects'));
    }



    public function viewEnrolledStudents($id)
    {
        $user = Auth::user();
        $subject = Subject::where('id', $id)->where('professor_id', $user->id)->first();

        if (!$subject) {
            return redirect()->back()->with('error', 'You are not authorized to view this subject.');
        }

        $students = $subject->enrollments()->with('user')->get();
        return view('professor.students', compact('subject', 'students'));
    }

    public function removeStudent($subject_id, $student_id)
    {
        $enrollment = Enrollment::where('subject_id', $subject_id)->where('user_id', $student_id)->first();
        if ($enrollment) {
            // Increment the available slots
            $subject = Subject::find($subject_id);
            if ($subject) {
                $subject->available_slots += 1;
                $subject->save();
            }
            $enrollment->delete();
            return redirect()->back()->with('success', 'Student removed successfully.');
        }
        return redirect()->back()->with('error', 'Student not found.');
    }

}

