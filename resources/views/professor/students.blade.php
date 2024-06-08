@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h1 style="color: #FFFFFF">Enrolled Students for {{ $subject->name }}</h1>
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

        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('professor.subjects') }}" class="btn btn-primary">Back to Subjects</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped bg-white">
                        <thead class="thead-dark">
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
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Student</button>
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
