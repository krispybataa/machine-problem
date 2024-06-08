@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Enrolled Students for {{ $subject->name }}</h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($enrollments->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No students are enrolled in this subject.
                    </div>
                @else
                    <ul class="list-group">
                        @foreach($enrollments as $enrollment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $enrollment->user->name }}
                                <form action="{{ route('professor.subjects.remove', ['subject_id' => $subject->id, 'student_id' => $enrollment->user_id]) }}" method="POST" class="ml-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Optional: Additional JavaScript for custom functionalities
    </script>
@endsection
