@extends('layouts.app')

@section('title', 'Index Jadwal Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Index Jadwal Guru</h4>

<div class="card">

  @include('layouts.alerts.session')

  <h5 class="card-header">
    <div class="d-flex justify-content-between">
      Nama Guru: {{ $teacher->name }}
    <a href="{{ route('jadwal.create', $teacher->id) }}" class="btn rounded-pill btn-primary">
      <i class='bx bx-plus-circle'></i> Tambah Jadwal
    </a>
    </div>
  </h5>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          {{-- <th>Mata Pelajaran</th> --}}
          {{-- <th>Kelas</th> --}}
          <th>Hari</th>
          <th>Waktu Checkin</th>
          <th>Waktu Checkout</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($teacher->schedules as $schedule)

        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $schedule->day->name }}</td>
          <td>{{ $schedule->checkin_time }}</td>
          <td>{{ $schedule->checkout_time }}</td>
          <td>
            <a href="{{ route('jadwal.edit', $schedule->id) }}" class="btn btn-sm rounded-pill btn-outline-info">Edit</a>

            <button onclick="handleDataDelete({{ $schedule->id }})" class="btn btn-sm rounded-pill btn-outline-danger">Delete</button>
            <form action="{{ route('jadwal.destroy', $schedule->id) }}" method="POST" id="form-delete-{{ $schedule->id }}">
              @csrf
              @method('DELETE')
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
@endsection

@section('js')
    <script>
        const handleDataDelete = (id) => {
            if (confirm('Hapus data ini?')) {
                document.getElementById(`form-delete-${id}`).submit();
            }
        } 
    </script>
@stop