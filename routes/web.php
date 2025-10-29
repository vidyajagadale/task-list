<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', ['task' => Task::findOrFail($id)]);
})->name('tasks.edit');

Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::create($data);

    return redirect()->route('tasks.show', $task)->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}', function (Request $request, $id) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->update($data);

    return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::fallback(function () {
    return "Still got somewhere!";
});

