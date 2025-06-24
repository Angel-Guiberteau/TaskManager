
<div class="d-flex justify-content-center gap-2">
    <button class="btn btn-warning btn-sm me-1 btn-edit" data-bs-toggle="modal" data-bs-target="#taskEditModal"
        data-task-id="{{ $task->id }}"
        data-task-name="{{ $task->name }}"
        data-task-description="{{ $task->description }}"
        data-task-assigned-user="{{ $task->user_name }}"
        data-task-priority="{{ $task->priority_name }}"
        data-task-resolution-date="{{ $task->resolution_date }}"  
        data-task-start-date="{{ $task->start_date }}"
        data-task-end-date="{{ $task->end_date }}"
        data-task-status="{{ $task->status }}">
        Edit
    </button>

    <button class="btn btn-danger btn-sm btn-delete" data-task-id="{{ $task->id }}">
        Delete
    </button>
</div>


