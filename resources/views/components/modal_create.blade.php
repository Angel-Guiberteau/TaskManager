<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-custom fs-2 center-title" id="taskModalLabel">Create new task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm" action="{{ route('addTask') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf 

                    <div class="mb-3">
                        <label for="taskName" class="form-label fw-semibold">Task name</label>
                        <input type="text" class="form-control shadow-sm" id="taskName" name="taskName" >
                    </div>

                    <div class="mb-3">
                        <label for="taskDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control shadow-sm" id="taskDescription" name="taskDescription" style="resize:none;" rows="3" ></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="assignedUser" class="form-label fw-semibold">Assigned User</label>
                            <select class="form-select shadow-sm" id="assignedUser" name="assignedUser" >
                                <option selected disabled hidden value=" ">- Select an option -</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="priority_id" class="form-label fw-semibold">Priority</label>
                            <select class="form-select shadow-sm" id="priority_id" name="priority_id" >
                                <option selected disabled hidden value=" ">- Select an option -</option>
                                @foreach($priority as $prio)
                                    <option value="{{ $prio->id }}">{{ $prio->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="resolutionDate" class="form-label fw-semibold">Resolution Date</label>
                        <input type="date" class="form-control shadow-sm" id="resolutionDate" name="resolutionDate" >
                    </div>

                    <input type="hidden" name="status" value="n">

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger shadow-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary shadow-sm">Save</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
