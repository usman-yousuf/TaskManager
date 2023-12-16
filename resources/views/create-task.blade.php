@extends('layout.app')

@section('title', 'Create Task - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h3>Create Task</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('store.task')}}" method="post">
                    @csrf
                    <div class="my-4">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" aria-describedby="titleHelp" aria-required="true">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="titleHelp">Enter your task title.</small>
                    </div>
                    <div class="my-4">
                        <label for="description">Description</label>
                        <textarea class="form-control text-area" name="description" id="description" aria-describedby="descriptionHelp" aria-required="true"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="descriptionHelp">Enter your task description.</small>
                    </div>
                    <div class="my-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" aria-describedby="statusHelp" aria-required="true">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="statusHelp">Enter your task status.</small>
                    </div>
                    <input class="btn btn-primary my-4" type="submit" value="Submit Your Task">
                </form>
            </div>
        </div>
    </div>
@endsection