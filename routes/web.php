<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

//the order matters for the routes

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        // 'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
  return view('edit', [
    'task' => $task
  ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
  return view('show', [
    'task' => $task
  ]);
})->name('tasks.show');


Route::post('/tasks', function (TaskRequest $request) {
  $data = $request->validated(); 
  $task = Task::create($data);

  return redirect()->route('tasks.show', ['task' => $task->id])
      ->with('success', 'Task created successfully.');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
  $data = $request->validated();
  $task->update($data);

  return redirect()->route('tasks.show', ['task' => $task->id])
      ->with('success', 'Task updated successfully.');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
  $task->delete();

  return redirect()->route('tasks.index')
      ->with('success', 'Task deleted successfully.');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
  $task->toggleComplete();

  return redirect()->back()
      ->with('success', 'Task completed successfully.');
})->name('tasks.toggle-complete');


Route::fallback(function () {
    return 'Page Not Found. Go Back to <a href="/">Main Page</a>';
});

