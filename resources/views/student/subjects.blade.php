@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Subjects</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('student.subjects.search') }}" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" name="query" placeholder="Search for subjects" value="{{ request('query') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Available Slots</th>
                <th>Enrolled Students</th>
                <th>Instructor</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->available_slots }}</td>
                    <td>{{ $subject->enrollments()->whereNotNull('finalized_at')->count() }}</td>
                    <td>{{ $subject->instructor }}</td>
                    <td>
                        <form action="{{ route('student.subjects.addToCart', $subject->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
