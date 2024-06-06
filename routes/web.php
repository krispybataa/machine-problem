<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:student'])->group(function () {
        // Student routes
        Route::get('/student/home', [StudentController::class, 'home'])->name('student.home');
        Route::get('/student/subjects', [StudentController::class, 'subjects'])->name('student.subjects');
        Route::post('/student/subjects/add-to-cart/{id}', [StudentController::class, 'addToCart'])->name('student.subjects.addToCart');
        Route::post('/student/cart/add/{id}', [App\Http\Controllers\StudentController::class, 'addToCart'])->name('student.cart.add');
        Route::post('/student/cart/finalize', [App\Http\Controllers\StudentController::class, 'finalizeCart'])->name('student.cart.finalize');
        Route::get('/student/cart', [App\Http\Controllers\StudentController::class, 'viewCart'])->name('student.cart');
        Route::post('/student/cart/remove/{id}', [App\Http\Controllers\StudentController::class, 'removeFromCart'])->name('student.cart.remove');
        Route::get('/student/subjects/search', [App\Http\Controllers\StudentController::class, 'searchSubjects'])->name('student.subjects.search'); // Add this line
    });


    Route::middleware(['auth', 'role:professor'])->group(function () {
        Route::get('/professor/home', [ProfessorController::class, 'home'])->name('professor.home');
        Route::get('/professor/subjects', [ProfessorController::class, 'subjects'])->name('professor.subjects'); // Updated route

        // Route for the view to add subjects
        Route::get('/professor/subjects/add', function () {
            return view('professor.add-subject');
        })->name('professor.subjects.add');

        // Route to handle the addition of subjects
        Route::post('/professor/subjects/add', [ProfessorController::class, 'addSubject'])->name('professor.subjects.add');

        // Route to view students enrolled in a subject
        Route::get('/professor/subjects/{id}/students', [ProfessorController::class, 'viewEnrolledStudents'])->name('professor.subjects.students');

        // Route to remove a student from a subject
        Route::post('/professor/subjects/{subject_id}/remove/{student_id}', [ProfessorController::class, 'removeStudent'])->name('professor.subjects.removeStudent');

        // Route to remove a subject
        Route::delete('/professor/subjects/remove/{id}', [ProfessorController::class, 'removeSubject'])->name('professor.subjects.remove');
    });

});

Route::get('/test', function () {
    return 'This should not be displayed if middleware works';
})->middleware('test');

