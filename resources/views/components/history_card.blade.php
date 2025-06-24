<div class="col-md-6 col-lg-4 mb-4 task-card"
    data-task-name="{{ $task->name }}"
    data-assigned-user="{{ $task->user_name }}"
    data-finish-date="{{ $task->end_date }}">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden task-card-hover">
        <div class="card-header bg-custom text-black text-center">
            <h5 class="card-title mb-0 fw-bold">{{ $task->name }}</h5>
        </div>
        <div class="card-body p-3">
            <p class="mb-1">
                <strong>Assigned User:</strong> {{ $task->user_name }}
            </p>
            <p class="mb-1">
                <strong>Description:</strong> {{ $task->description }}
            </p>
            
            <p class="mb-1">
                <strong>Resolution Date:</strong>
                <span class="{{ $task->resolution_date < $task->end_date ? 'text-danger fw-bold' : '' }}">
                    {{ $task->resolution_date }}
                    @if ($task->resolution_date < $task->end_date)
                        <small> !Out of time!</small>
                    @endif
                </span>
            </p>
            
            <div class="d-flex justify-content-between">
                <p class="mb-1"><strong>Start:</strong> {{ $task->start_date }}</p>
                <p class="mb-1"><strong>End:</strong> {{ $task->end_date }}</p>
            </div>
            
            <p class="mb-1"><strong>Priority:</strong>
                <span class="badge bg-{{ $task->priority_name == 'high' ? 'danger' : ($task->priority_name == 'medium' ? 'warning' : 'success') }} p-2">
                    {{ ucfirst($task->priority_name) }}
                </span>
            </p>
            
            <p class="mb-1"><strong>Status:</strong>
                <span class="badge bg-{{ $task->status == 'f' ? 'success' : ($task->status == 's' ? 'warning' : 'danger') }} p-2">
                    {{ $task->status == 'f' ? 'Completed' : ($task->status == 's' ? 'In Progress' : 'Not Started') }}
                </span>
            </p>
        </div>
        <div class="card-footer text-muted bg-light text-center small">
            Finished on {{ $task->end_date }}
        </div>
    </div>
</div>
