@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2>Enrolled Subjects</h2>
                            </div>
                            <div>
                                <a href="{{ route('student.subjects') }}" class="btn btn-primary mr-2">Search Subjects</a>
                                <a href="{{ route('student.cart') }}" class="btn btn-primary">View Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($enrollments->isEmpty())
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
                                @foreach($enrollments as $enrollment)
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
                </div>
            </div>
        </div>
    </div>
@endsection
