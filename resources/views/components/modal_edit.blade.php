<div class="modal fade" id="taskEditModal" tabindex="-1" aria-labelledby="taskEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold fs-2 text-custom mx-auto center-title" id="taskEditModalLabel" >Editar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskEditForm" action="{{ route('editTask') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf 

                    {{-- <div class="mb-3"> --}}
                        {{-- <label for="taskEditId" class="form-label fw-semibold">ID</label> --}}
                        <input type="text" class="form-control shadow-sm" id="taskEditId" name="taskId" readonly hidden>
                    {{-- </div> --}}

                    <div class="mb-3">
                        <label for="taskEditName" class="form-label fw-semibold">Task name</label>
                        <input type="text" class="form-control shadow-sm" id="taskEditName" name="taskName" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="taskEditDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control shadow-sm" id="taskEditDescription" name="taskDescription" style="resize:none;" rows="3" ></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="assignedEditUser" class="form-label fw-semibold">Assigned user</label>
                            <select class="form-select shadow-sm" id="assignedEditUser" name="assignedUser" >
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="priority_idEdit" class="form-label fw-semibold">Priority</label>
                            <select class="form-select shadow-sm" id="priority_idEdit" name="priority_id" >
                                @foreach($priority as $prio)
                                    <option value="{{ $prio->id }}">{{ $prio->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="resolutionDateEdit" class="form-label fw-semibold">Resolution date</label>
                        <input type="date" class="form-control shadow-sm" id="resolutionDateEdit" name="resolutionDate" >
                    </div>

                    <div class="mb-3">
                        <label for="startDateEdit" class="form-label fw-semibold">Start date</label>
                        <input type="date" class="form-control shadow-sm" id="startDateEdit" name="startDate" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="endDateEdit" class="form-label fw-semibold">End date</label>
                        <input type="date" class="form-control shadow-sm" id="endDateEdit" name="endDate" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="statusEdit" class="form-label fw-semibold">Status</label>
                        <select class="form-select shadow-sm" id="statusEdit" name="status" >
                            <option value="n">Not Started</option>
                            <option value="s">Started</option>
                            <option value="f">Finished</option>
                        </select>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger shadow-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary shadow-sm">Save changes</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
