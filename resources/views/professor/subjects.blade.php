@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Professor Dashboard</h1>
        <a href="{{ route('professor.subjects.add') }}">Add Subjects</a>
        <table class="table">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Available Slots</th>
                <th>Enrolled Students</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->available_slots }}</td>
                    <td>{{ $subject->enrollments_count }}</td>
                    <td>
                        <a href="{{ route('professor.subjects.students', $subject->id) }}">View Students</a>
                        <form action="{{ route('professor.subjects.remove', $subject->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove Subject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
