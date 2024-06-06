@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Subject</h1>
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
        <form action="{{ route('professor.subjects.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Subject Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="available_slots">Available Slots</label>
                <input type="number" class="form-control" id="available_slots" name="available_slots" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Subject</button>
        </form>
    </div>
@endsection
