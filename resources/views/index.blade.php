@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<button class="mb-4 btn">
    <a href="{{ route('tasks.create') }}">Add Task</a>
</button>

<p class="text-slate-700 bg-gray-200 py-2 px-3">Here are your todos:</p>
<ul class="divide-y divide-gray-200">
    @forelse ($tasks as $task)
        <li class="p-2"><a href="{{ route('tasks.show', ['task' => $task->id]) }}"
            @class(['text-md', 'line-through' => $task->completed])>{{$task->title}}</a>
        </li>            
        @empty
        <li>No tasks yet!</li>
        @endforelse
</ul>

@if ($tasks->count())
    <nav class="mt-4">
        {{$tasks->links()}}
    </nav>
@endif


@endsection