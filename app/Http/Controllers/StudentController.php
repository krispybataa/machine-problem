<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $enrollments = Enrollment::where('user_id', $user->id)
            ->whereNotNull('finalized_at')
            ->with('subject.professor')
            ->get();

        return view('student.home', compact('enrollments'));
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $enrollments = Enrollment::where('user_id', $user->id)
                ->whereNotNull('finalized_at')
                ->with('subject')
                ->get();

            return view('student.home', compact('enrollments'));
        } elseif ($user->role === 'professor') {
            $subjects = Subject::all();
            return view('professor.home', compact('subjects'));
        }

        return view('home');
    }


    public function searchSubjects(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $subjects = Subject::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $subjects = Subject::all();
        }

        return view('student.subjects', compact('subjects'));
    }


    public function subjects()
    {
        $subjects = Subject::withCount(['enrollments' => function ($query) {
            $query->whereNotNull('finalized_at');
        }])->get();

        return view('student.subjects', compact('subjects'));
    }


    public function addToCart($id)
    {
        $subject = Subject::find($id);
        $user = Auth::user();

        // Check if the subject is already in the cart or already finalized
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('subject_id', $subject->id)
            ->whereNull('finalized_at')
            ->first();

        $alreadyFinalized = Enrollment::where('user_id', $user->id)
            ->where('subject_id', $subject->id)
            ->whereNotNull('finalized_at')
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'Subject is already in your cart!');
        }

        if ($alreadyFinalized) {
            return redirect()->back()->with('error', 'You are already enrolled in this subject!');
        }

        Enrollment::create([
            'user_id' => $user->id,
            'subject_id' => $subject->id,
        ]);

        return redirect()->back()->with('success', 'Subject added to cart!');
    }


    public function viewCart()
    {
        $user = Auth::user();
        $enrollments = Enrollment::where('user_id', $user->id)
            ->whereNull('finalized_at')
            ->with('subject')
            ->get();

        return view('student.cart', compact('enrollments'));
    }

    public function finalizeCart()
    {
        $user = Auth::user();
        $enrollments = Enrollment::where('user_id', $user->id)
            ->whereNull('finalized_at')
            ->get();

        foreach ($enrollments as $enrollment) {
            $enrollment->finalized_at = now();
            $enrollment->save();

            // Decrease the available slots
            $subject = $enrollment->subject;
            $subject->available_slots -= 1;
            $subject->save();
        }

        return redirect()->route('student.cart')->with('success', 'Enrollment finalized successfully!');
    }


    public function removeFromCart($id)
    {
        $user = Auth::user();
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('subject_id', $id)
            ->whereNull('finalized_at')
            ->first();

        if ($enrollment) {
            $enrollment->delete();
        }

        return redirect()->route('student.cart')->with('success', 'Subject removed from cart!');
    }

}

