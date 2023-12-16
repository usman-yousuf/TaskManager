@extends('layout.app')

@section('title', 'Edit Task - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h3>Edit Task</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update.task', $task->id) }}" method="post">
                    @csrf
                    <div class="my-4">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" aria-describedby="titleHelp" aria-required="true" value="{{ $task->title }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="titleHelp">Enter your task title.</small>
                    </div>
                    <div class="my-4">
                        <label for="description">Description</label>
                        <textarea class="form-control text-area" name="description" id="description" aria-describedby="descriptionHelp" aria-required="true">{{ $task->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="descriptionHelp">Enter your task description.</small>
                    </div>
                    <div class="my-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" aria-describedby="statusHelp" aria-required="true">
                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="statusHelp">Enter your task status.</small>
                    </div>
                    <input class="btn btn-primary my-4" type="submit" value="Update Task">
                </form>
            </div>
        </div>
    </div>
@endsection
