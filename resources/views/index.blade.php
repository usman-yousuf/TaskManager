@extends('layout.app')

@section('title', 'Task List - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-10 text-center">
                <h3>Task Manager</h3>
            </div>
            <div>
                <a href="{{ route('logout')}}" class="btn btn-primary" role="button">logout</a>
            </div>
        </div>
        @if ($tasks->count() > 0)
        <div>
            <div class="row my-4">
                <div class="col-12">
                    <form class="d-flex" action="{{ route('task.list') }}" method="get">
                        <label for="search"><strong>Search:</strong></label>
                        <input type="search" class="form-control w-25 mx-2" placeholder="Search here" name="search" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary mx-2">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
                    @endif
                    <table class="table border border-dark text-center">
                        <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <th class="bg-light">{{$task->title}}</th>
                                <td>{{$task->description}}</td>
                                @if ($task->status == 'pending')
                                    <td class="text-warning bg-light"><strong>{{$task->status}}</strong></td>
                                @else
                                <td class="text-success bg-light"><strong>{{$task->status}}</strong></td>
                                @endif
                                <td>
                                    <a href="{{ route('show.task', ['task' => $task->id])}}" class="btn btn-secondary" role="button" aria-label="View Task Details">
                                        <span class="d-flex align-items-center">
                                            <i class="fa fa-eye mr-2" aria-hidden="true"></i> 
                                            View
                                        </span>
                                    </a>
                                    <a href="{{ route('edit.task.view', ['task' => $task->id])}}" class="btn btn-primary" role="button" aria-label="Edit Task">
                                        <span class="d-flex align-items-center">
                                            <i class="fa fa-pencil mr-2" aria-hidden="true"></i> 
                                            Edit
                                        </span>
                                    </a>
                                    <form action="{{ route('delete.task', $task->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row my-4">
                        <div class="col-12">
                            <div class="custom-pagination-container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        @if ($tasks->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev" aria-label="« Previous">Previous</a>
                                            </li>
                                        @endif
                                
                                        @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                            <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                
                                        @if ($tasks->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next" aria-label="Next »">Next</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                                                <span class="page-link" aria-hidden="true">Next »</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <div >
                    <h5><Strong>No Task available here.</Strong></h5>
                </div>
            </div>
        </div>
        @endif
        <div class="row my-4">
            <div class="col-12">
                <div>
                    <a href="{{ route('create.task.view')}}" class="btn btn-primary" role="button">Create Task</a>
                    <a href="{{ route('bin.task')}}" class="btn btn-danger" role="button">Bin Tasks</a>
                </div>
            </div>
        </div>
    </div>
@endsection