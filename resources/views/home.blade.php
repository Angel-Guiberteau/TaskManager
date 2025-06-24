@extends('layout')

@section('title', 'TaskManager')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5">Welcome to Task Manager</h2>
    <div class="row text-center justify-content-center">

        <!-- Admin Card -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-lg card-custom">
                <img src="{{ asset('img/adminImg.png') }}" class="card-img-top card-img-custom mt-4" alt="Admin Image">
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <p class="card-text">Manage tasks, CRUD operations, and oversee user activities.</p>
                    <a href="{{ route('admin') }}" class="btn btn-primary">
                        Go to Admin
                    </a>
                </div>
            </div>
        </div>

        <!-- User Card -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-lg card-custom">
                <img src="{{ asset('img/userImg.png') }}" class="card-img-top card-img-custom mt-4" alt="User Image">
                <div class="card-body">
                    <h5 class="card-title">User  View</h5>
                    <p class="card-text">View and manage your assigned tasks, keep track of your progress.</p>
                    <a href="{{ route('user') }}" class="btn btn-primary">
                        Go to User View
                    </a>
                </div>
            </div>
        </div>

        <!-- History Card -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-lg card-custom">
                <img src="{{ asset('img/historyImg.png') }}" class="card-img-top card-img-custom mt-4" alt="History Image">
                <div class="card-body">
                    <h5 class="card-title">Task History</h5>
                    <p class="card-text">Access your complete task history and past actions.</p>
                    <a href="{{ route('history') }}" class="btn btn-primary">
                        Go to History
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection