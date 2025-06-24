<div class="col-md-12 mb-4 taskUserCard" 
    data-name="{{ $task->name }}"
    data-user="{{ $userName }}" 
    data-date="{{ $task->resolution_date }}"
    data-status="{{ $task->status_name }}">
    
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-custom text-black text-center">
            <h5 class="card-title mb-0 fw-bold">{{ $task->name }}</h5>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Task Name:</strong> {{ $task->name }}</p>
                    <p class="mb-1"><strong>Assigned User:</strong> {{ $task->user_name }}</p>
                    <p class="mb-1"><strong>Description:</strong> {{ $task->description }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Resolution Date:</strong>
                        <span class="{{ $task->resolution_date < now() ? 'text-danger fw-bold' : '' }}">
                            {{ $task->resolution_date }}
                            @if ($task->resolution_date < now())
                                <br><small>!Out of time!</small>
                            @endif
                        </span>
                    </p>
                    <p class="mb-1">
                        <strong>Start Date:</strong> {{ $task->start_date }}
                    </p>
                    <p class="mb-1">
                        <strong>End Date:</strong> {{ $task->end_date }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <p class="mb-1"><strong>Priority:</strong>
                    <span class="badge bg-{{ $task->priority_name == 'high' ? 'danger' : ($task->priority_name == 'medium' ? 'warning' : 'success') }} p-2">
                        {{ ucfirst($task->priority_name) }}
                    </span>
                </p>
                <p class="mb-1">
                    <strong>Status: </strong>
                    <span class="badge bg-{{ $task->status == 'f' ? 'success' : ($task->status == 's' ? 'warning' : 'danger') }} p-2">
                        {{ $task->status == 'f' ? 'Completed' : ($task->status == 's' ? 'In Progress' : 'Not Started') }}
                    </span>
                </p>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light text-center small">
            @if($task->status == 'n')
                @include('components.start_task')
            @endif
            @if($task->status == 's')
                @include('components.end_task')
            @endif
        </div>
    </div>
</div>