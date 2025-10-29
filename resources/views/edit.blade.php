@extends('layouts.app')

@section('title', 'Edit Task')

@section('styles')
    <style>
        .error {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $task->title }}">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5">{{ $task->description }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description" rows="10">{{ $task->long_description }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit">Update Task</button>
        </div>
    </form>
@endsection
