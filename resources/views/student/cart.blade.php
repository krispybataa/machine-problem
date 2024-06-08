@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Your Cart</h3>
                    </div>
                    <div class="card-body">
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

                        @if($enrollments->isEmpty())
                            <p>Your cart is empty.</p>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Available Slots</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->subject->name }}</td>
                                        <td>{{ $enrollment->subject->available_slots }}</td>
                                        <td>
                                            <form action="{{ route('student.cart.remove', $enrollment->subject_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form action="{{ route('student.cart.finalize') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Finalize Enrollment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
