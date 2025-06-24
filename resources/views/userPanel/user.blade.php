@extends('layout')

@section('title', 'User  Panel')

@section('user_active', 'active')

@section('content')
<section id="user-panel" class="my-5">
    <h2 class="mb-4 text-center">User  Panel</h2>

    @include('components.task_search_filters')

    @if ($users->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No users found
        </div>
    @endif

    @foreach($users as $user)
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-2 fs-3 border-bottom pb-2">Tasks of {{ $user->name }}</h4>
            </div>

            <div class="col-12">
                <div class="row">
                    
                    <!-- Pending Tasks -->
                    <div class="col-md-6">
                        <h5 class="mb-3 mt-4">Pending</h5>
                        @empty($tasksByStatus[$user->name]['pending'])
                            <p class="text-muted">No pending tasks found for {{ $user->name }}</p>
                        @else
                            @foreach($tasksByStatus[$user->name]['pending'] as $task)
                                @include('components.task_user_card', ['task' => $task, 'userName' => $user->name])
                            @endforeach
                        @endempty
                    </div>

                    <!-- In Progress Tasks -->
                    <div class="col-md-6">
                        <h5 class="mb-3 mt-4">In Progress</h5>
                        @empty($tasksByStatus[$user->name]['in_progress'])
                            <p class="text-muted">No in-progress tasks found for {{ $user->name }}</p>
                        @else
                            @foreach($tasksByStatus[$user->name]['in_progress'] as $task)
                                @include('components.task_user_card', ['task' => $task, 'userName' => $user->name])
                            @endforeach
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>

@include('components.sweet_alert')
@endsection