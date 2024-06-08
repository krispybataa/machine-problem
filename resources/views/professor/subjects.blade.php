@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h1 style="color: #FFFFFF">Professor Dashboard</h1>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('professor.subjects.add') }}" class="btn btn-primary">Add Subjects</a>
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
                                    <a href="{{ route('professor.subjects.students', $subject->id) }}" class="btn btn-info btn-sm">View Students</a>
                                    <form action="{{ route('professor.subjects.remove', $subject->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Subject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
