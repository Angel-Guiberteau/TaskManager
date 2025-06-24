<div class="row mb-4">
    <div class="col-md-6 col-lg-4 mb-3">
        <label for="taskSearch" class="form-label">Search Task</label>
        <input type="text" class="form-control" id="taskSearch" placeholder="Search by task name..." oninput="filterTasks()">
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
        <label for="userFilter" class="form-label">User  Filter</label>
        <select class="form-select" id="userFilter" onchange="filterTasks()">
            <option value="">All</option>
            @foreach($users as $user)
                <option value="{{ $user->name }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
        <label for="dateFilter" class="form-label">Filter by Resolution Date</label>
        <input type="date" class="form-control" id="dateFilter" onchange="filterTasks()">
    </div>
</div>