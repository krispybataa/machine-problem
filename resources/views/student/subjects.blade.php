{{-- resources/views/student/subjects.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h2 style="color: #FFFFFF">Search Subjects</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="row mb-3">
                <div class="col">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="row mb-3">
                <div class="col">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col">
                <form action="{{ route('student.subjects') }}" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-sm-2 mb-2" placeholder="Search for subjects" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('student.cart') }}" class="btn btn-secondary">View Cart</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped bg-white">
                        <thead class="thead-dark">
                        <tr>
                            <th>Subject</th>
                            <th>Available Slots</th>
                            <th>Enrolled Students</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->available_slots }}</td>
                                <td>{{ $subject->enrollments()->whereNotNull('finalized_at')->count() }}</td>
                                <td>{{ $subject->professor->name }}</td>
                                <td>
                                    <form action="{{ route('student.subjects.addToCart', $subject->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                                    </form>
                                </td>
                            <tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
