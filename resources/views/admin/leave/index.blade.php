@extends('layouts.app')

@section('title', 'List Pengajuan Izin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">List Pengajuan Izin</h4>

<div class="card">

  @if (Session::has('message'))
  
  <div class="alert alert-primary alert-dismissible" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  @endif

  {{-- <h5 class="card-header">
    <a href="{{ route('guru.create') }}" class="btn rounded-pill btn-primary">
      <i class='bx bx-plus-circle'></i> Tambah
    </a>
  </h5> --}}
  
  <div class="table-responsive text-nowrap p-3">
    <table class="table" id="main-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Tipe Izin</th>
          <th>Jangka Waktu</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($leaves as $leave)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $leave->teacher->name }}</td>
          <td>{{ getLeaveTypeLabel($leave->leave_type) }}</td>
          <td>
            {{ $leave->from_date }} <i class='bx bx-chevron-right'></i> {{ $leave->to_date }}
          </td>
          <td>{!! getApprovalStatusChip($leave->approval_status) !!}</td>
          <td>
            <a href="{{ route('izin.show', $leave->id) }}" class="btn btn-sm rounded-pill btn-outline-primary">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
@endsection

@section('js')
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

  <script>
    $('#main-table').DataTable();  
      const handleDataDelete = (id) => {
          if (confirm('Hapus data ini?')) {
              document.getElementById(`form-delete-${id}`).submit();
          }
      } 
  </script>
@stop