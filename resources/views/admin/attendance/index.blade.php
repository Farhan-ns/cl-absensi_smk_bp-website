@extends('layouts.app')

@section('title', 'List Kehadiran')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">List Kehadiran</h4>

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
  </h5>
   --}}
  <div class="table-responsive text-nowrap p-3">
    <table class="table" id="main-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Nama</th>
          <th>Checkin/Checkout/Izin</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($attendances as $attendance)
        <tr>
          <td>{{ $i++ }}</td>
          <td>
            {{ Carbon\Carbon::parse($attendance->submit_time)->format('d M Y'); }}
          </td>
          <td>
            {{ Carbon\Carbon::parse($attendance->submit_time)->format('H:i'); }}
          </td>
          <td>{{ $attendance->teacher->name }}</td>
          <td>
            @if ($attendance->submit_type === 'leave')
              Izin 
            @else
            {{ Str::ucfirst($attendance->submit_type) }}
            @endif
          </td>
          <td>{{ getAttendanceStatusLabel($attendance->attendance_status) }}</td>
          
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