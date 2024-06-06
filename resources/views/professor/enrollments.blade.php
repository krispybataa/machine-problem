@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Enrolled Students for {{ $subject->name }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <ul>
            @foreach($enrollments as $enrollment)
                <li>
                    {{ $enrollment->user->name }}
                    <form action="{{ route('professor.subjects.remove', ['subject_id' => $subject->id, 'student_id' => $enrollment->user_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Remove Student</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
