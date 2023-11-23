@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')


@section('content')
    <div class="mb-4">
        <h1>Create a new post</h1>
        <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
            @csrf
            @isset($task)
                @method('PUT')
            @endisset

            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter post title" value="{{ $task->title ?? old('title')}}"
                    @class(['border-red-500' => $errors->has('title')])
                />
                @error('title')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5"                    
                 @class(['border-red-500' => $errors->has('description')])
                    >{{ $task->description ?? old('description')}}</textarea>
                @error('description')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="long_description">Long description</label>
                <textarea id="long_description" name="long_description" rows="10"
                @class(['border-red-500' => $errors->has('long_description')])
                >{{ $task->long_description ?? old('long_description')}}</textarea>
                @error('long_description')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex gap-2 items-center justify-between">
                <button type="submit" class="btn">@isset($task) 
                    Update task 
                    @else
                    Add task
                    @endisset
                </button>
                <a href="{{route('tasks.index')}}" class="link">Cancel</a>
            </div>
        </form>
    </div>

@endsection