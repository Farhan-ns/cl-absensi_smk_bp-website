@extends('layouts.app')

@section('title', 'Detail Pengajuan Izin')

@section('content')
<h4 class="fw-bold py-3 mb-4">Detail Pengajuan Izin</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Tambah Guru</h5> --}}
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-end gap-2">

            @if ($isApproved)
                {{-- <form action="{{ route('izin.reject') }}" method="post">
                    <input type="hidden" name="id" value="{{ $leave->id }}">
                    @csrf
                    <button type="submit" class="btn rounded-pill btn-danger">
                        <i class='bx bxs-x-circle'></i> Reject
                    </button>
                </form> --}}

            @elseif ($isRejected)
                <form action="{{ route('izin.approve') }}" method="post">
                    <input type="hidden" name="id" value="{{ $leave->id }}">
                    @csrf
                    <button type="submit" class="btn rounded-pill btn-success">
                        <i class='bx bx-check-circle'></i> Approve
                    </button>
                </form>

            @else
                <form action="{{ route('izin.approve') }}" method="post">
                    <input type="hidden" name="id" value="{{ $leave->id }}">
                    @csrf
                    <button type="submit" class="btn rounded-pill btn-success">
                        <i class='bx bx-check-circle'></i> Approve
                    </button>
                </form>
                <form action="{{ route('izin.reject') }}" method="post">
                    <input type="hidden" name="id" value="{{ $leave->id }}">
                    @csrf
                    <button type="submit" class="btn rounded-pill btn-danger">
                        <i class='bx bxs-x-circle'></i> Reject
                    </button>
                </form>
            @endif
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <h5> <b class="text-muted">Nama:</b> {{ $leave->teacher->name }}</h5>
                <h5> <b class="text-muted">Nomor Telepon:</b> {{ $leave->teacher->phone }}</h5>
                <h5> <b class="text-muted">Email:</b> {{ $leave->teacher->email }}</h5>
                <h5> <b class="text-muted">Status:</b> {{ getApprovalStatusLabel($leave->approval_status) }}</h5>
            </div>
            <div class="col-6">
                <h5> <b class="text-muted">Tipe izin:</b> {{ getLeaveTypeLabel($leave->leave_type) }}</h5>
                <h5> <b class="text-muted">Alasan izin:</b> {{ $leave->absence_reason }}</h5>
                <h5>
                    <b class="text-muted">Jangka Waktu:</b>
                    {{ Carbon\Carbon::parse($leave->from_date)->format('d M Y'); }}
                    Hingga
                    {{ Carbon\Carbon::parse($leave->to_date)->format('d M Y'); }}
                </h5>
                <h5> <b class="text-muted">Catatan:</b> {{ $leave->absence_note }}</h5>
                <a href="{{ route('izin.download', $leave->id) }}" class="btn rounded-pill btn-primary">
                    <i class='bx bx-download'></i> Download Dokumen Izin
                </a>
            </div>
        </div>


    </div>
</div>
@endsection