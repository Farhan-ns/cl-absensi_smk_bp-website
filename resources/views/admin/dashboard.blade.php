@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-12 col-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class='bx bx-user-circle display-4'></i>
                    </div>
                    {{-- <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div> --}}
                </div>
                <span>Admin</span>
                <h3 class="card-title text-nowrap mb-1">{{ $adminCount }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class='bx bx-user display-4'></i>
                    </div>
                    {{-- <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div> --}}
                </div>
                <span>Guru</span>
                <h3 class="card-title text-nowrap mb-1">{{ $teacherCount }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class='bx bx-list-ul display-4' ></i>
                    </div>
                    {{-- <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div> --}}
                </div>
                <span>Pengajuan Izin</span>
                <h3 class="card-title text-nowrap mb-1">{{ $leaveCount }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
            </div>
        </div>
    </div>

</div>

@endsection

@if (Session::has('swal-success'))
    @section('js')
        <script>
            Swal.fire('{{ Session::get('swal-success') }}', '', 'success')
        </script>
    @endsection
@elseif (Session::has('swal-failed'))
    @section('js')
        <script>
            Swal.fire('{{ Session::get('swal-failed') }}', '', 'error')
        </script>
    @endsection
@endif