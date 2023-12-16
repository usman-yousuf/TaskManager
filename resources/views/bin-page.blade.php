@extends('layout.app')

@section('title', 'Task List - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h3>Deleted Tasks</h3>
            </div>
        </div>
        @if ($deletedTasks->count() > 0)
            <div class="row my-4">
                <div class="col-12">
                    <form class="d-flex" action="{{ route('bin.task') }}" method="get">
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
                            @foreach ($deletedTasks as $task)
                            <tr>
                                <th class="bg-light">{{$task->title}}</th>
                                <td>{{$task->description}}</td>
                                @if ($task->status == 'pending')
                                    <td class="text-warning bg-light"><strong>{{$task->status}}</strong></td>
                                @else
                                <td class="text-success bg-light"><strong>{{$task->status}}</strong></td>
                                @endif
                                <td>
                                    <form action="{{ route('resotre.task', $task->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to restore this task?')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('destroy.task',  ['task' => $task->id]) }}" method="post" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
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
                                        @if ($deletedTasks->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $deletedTasks->previousPageUrl() }}" rel="prev" aria-label="« Previous">Previous</a>
                                            </li>
                                        @endif
                                
                                        @for ($i = 1; $i <= $deletedTasks->lastPage(); $i++)
                                            <li class="page-item {{ $deletedTasks->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $deletedTasks->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                
                                        @if ($deletedTasks->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $deletedTasks->nextPageUrl() }}" rel="next" aria-label="Next »">Next</a>
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
                <a href="{{ route('task.list') }}" class="btn btn-primary my-4" role="button" aria-label="Back to Tasks">
                    <span class="d-flex align-items-center">
                        <span class="mr-2" aria-hidden="true">&#8592;</span>    
                        Back to Tasks List
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection