@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/user/index.css') }}">

    <div class="container-fluid">
        <div class="users-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-users me-3"></i> Users ({{ $users->count() }})
                </h2>
            </div>

            <div class="form-card-wrapper p-4">

                <!-- Search Form -->
                <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control search-bar"
                                placeholder="Search by name..." style="color: #fff; ::placeholder { color: #fff; opacity: 1; }" 
                                onfocus="this.style.color='#fff';" 
                                onblur="this.style.color='#fff';">
                        </div>
                        <div class="col-12 col-md-2">
                            <button type="submit" class="btn btn-booking w-100">
                                <i class="fas fa-search me-2"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
                <!-- End Search Form -->

                <div class="table-responsive">
                    <table class="table table-users">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th class="text-center"> Rendez-vous terminer</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>#{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <span class="appointment-count {{ $user->appointments_count ? 'has-appointments' : '' }}">
                                        {{ App\Models\Appointments::where('status', 'completed')->where('user_id', $user->id)->count() }}
                                    </span>
                                </td>
                                {{-- <td>
                                    <div class="d-flex action-buttons">
                                        <a href="#" class="btn-action btn-view" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    @if(method_exists($users, 'links'))
                        {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection