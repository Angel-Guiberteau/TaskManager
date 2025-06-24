@extends('layout')

@section('title', 'History Panel')

@section('history_active', 'active')

@section('content')
<section id="task-history" class="my-5">
    <h2 class="mb-4 text-center">History of Completed Tasks</h2>

    @include('components.task_search_filters')

    @if ($users->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No users found
        </div>
    @endif

    @foreach($users as $user)
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-2 fs-3 border-bottom pb-2">Completed Tasks of {{ $user->name }}</h4>
            </div>

            <div class="col-12">
                <div class="row">
                    @foreach($tasksCompleted as $task)
                        @if($task->user_name == $user->name)
                            @include('components.history_card', ['task' => $task, 'userName' => $user->name])
                        @endif
                    @endforeach

                    @if($tasksCompleted->where('user_name', $user->name)->count() == 0)
                        <p class="text-muted">No completed tasks found for {{ $user->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</section>

@include('components.sweet_alert')
@endsection