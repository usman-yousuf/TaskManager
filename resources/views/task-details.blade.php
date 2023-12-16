@extends('layout.app')

@section('title', 'Task Details - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h3>Task Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="my-4">
                    <label for="title"><h5>Title:</h5></label>
                    <p>{{ $task->title }}</p>
                </div>
                <div class="my-4">
                    <label for="description"><h5>Description:</h5></label>
                    <p>{{ $task->description }}</p>
                </div>
                <div class="my-4">
                    <label for="status"><h5>Status:</h5></label>
                    @if ($task->status == 'pending')
                        <p class="text-warning"><strong>{{ $task->status }}</strong></p>
                    @else
                        <p class="text-success"><strong>{{ $task->status }}</strong></p>
                    @endif
                </div>
                
                <a href="{{ route('task.list') }}" class="btn btn-primary my-4" role="button" aria-label="Back to Tasks">
                    <span class="d-flex align-items-center">
                        <span class="mr-2" aria-hidden="true">&#8592;</span>    
                        Back to Tasks
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
