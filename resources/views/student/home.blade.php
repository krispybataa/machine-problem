@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Enrolled Subjects</h1>
        <div>
            <a href="{{ route('student.subjects') }}">Search Subjects</a>
            <a href="{{ route('student.cart') }}">View Cart</a>
        </div>
        @if ($enrollments->isEmpty())
            <p>You are not enrolled in any subjects.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>Available Slots</th>
                    <th>Instructor</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->subject->name }}</td>
                        <td>{{ $enrollment->subject->available_slots }}</td>
                        <td>{{ $enrollment->subject->professor->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
