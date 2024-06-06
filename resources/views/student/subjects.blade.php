{{-- resources/views/student/subjects.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2>Search Subjects</h2>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('student.subjects') }}" method="GET" class="form-inline mb-3">
                    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search for subjects" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <a href="{{ route('student.cart') }}" class="btn btn-secondary mb-3">View Cart</a>

                <table class="table table-striped">
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
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->available_slots }}</td>
                            <td>{{ $subject->enrollments()->whereNotNull('finalized_at')->count() }}</td>
                            <td>{{ $subject->professor->name }}</td>
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
        </div>
    </div>
@endsection
