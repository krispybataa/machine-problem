@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Enrolled Students for {{ $subject->name }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $enrollment)
                <tr>
                    <td>{{ $enrollment->user->name }}</td>
                    <td>{{ $enrollment->user->email }}</td>
                    <td>
                        <form action="{{ route('professor.subjects.removeStudent', ['subject_id' => $subject->id, 'student_id' => $enrollment->user->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove Student</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('professor.subjects') }}" class="btn btn-primary">Back to Subjects</a>
    </div>
@endsection
