@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Professor Dashboard</h1>
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
        <a href="{{ route('professor.subjects') }}">Manage Subjects</a>
        <table>
            <thead>
            <tr>
                <th>Subject</th>
                <th>Available Slots</th>
                <th>Enrolled Students</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->available_slots }}</td>
                    <td>{{ $subject->enrollments->count() }}</td>
                    <td>
                        <a href="{{ route('professor.subjects.students', ['id' => $subject->id]) }}">View Students</a>
                        <form action="{{ route('professor.subjects.remove', ['id' => $subject->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove Subject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
