@extends('layout')

@section('title', 'Admin Panel')

@section('admin_active', 'active')

@section('content')
<section id="admin-panel" class="my-5">
    <h2 class="admin-title text-center mb-4">Administration Panel</h2>
    <button class="btn btn-secondary my-3" data-bs-toggle="modal" data-bs-target="#taskModal">Create New Task</button>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Assigned User</th>
                    <th>Priority</th>
                    <th>Resolution Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($allTasks->isEmpty())
                    <tr>
                        <td colspan="10" class="text-muted">No tasks found</td> 
                    </tr>
                @endif
                @foreach ($allTasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td class="task-desc">{{ $task->description }}</td>
                        <td>{{ $task->user_name }}</td>
                        <td>
                            <span class="badge priority-badge {{ $task->priority_name == 'high' ? 'bg-danger' : ($task->priority_name == 'medium' ? 'bg-warning' : 'bg-success') }} p-2">{{ $task->priority_name }}</span>
                        </td>
                        <td>
                            @if ($task->resolution_date < now())
                                <span class="text-danger">{{ $task->resolution_date }} <br> !Out of time¡ </span>
                            @else
                                {{ $task->resolution_date }}
                            @endif
                        </td>
                        <td>{{ $task->start_date }}</td>
                        <td>{{ $task->end_date }}</td>
                        <td>
                            <span class="badge status-badge {{ $task->status == 'f' ? 'bg-success' : ($task->status == 's' ? 'bg-warning' : 'bg-danger') }} p-2">{{ $task->status == 'f' ? 'Completed' : ($task->status == 's' ? 'Started' : 'Not Started') }}</span>
                        </td>
                        <td>
                            @include('components.action_buttons')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @include('components.modal_edit')
    @include('components.modal_create')
    @include('components.sweet_alert')
</section>
@endsection