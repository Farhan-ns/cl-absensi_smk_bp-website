@extends('layouts.app')

@section('title', 'Index Guru')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Index Guru</h4>

<div class="card">

  @if (Session::has('message'))
  
  <div class="alert alert-primary alert-dismissible" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  @endif

  <h5 class="card-header">
    <a href="{{ route('guru.create') }}" class="btn rounded-pill btn-primary">
      <i class='bx bx-plus-circle'></i> Tambah
    </a>
  </h5>
  
  <div class="table-responsive text-nowrap p-3">
    <table class="table" id="main-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Mapel</th>
          <th>Nomor Telepon</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($teachers as $teacher)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $teacher->name }}</td>
          <td>{{ $teacher->class_grade ?? '-' }}</td>
          <td>{{ $teacher->subject ?? '-' }}</td>
          <td>{{ $teacher->phone ?? '-' }}</td>
          <td>
            <a href="{{ route('guru.show', $teacher->id) }}" class="btn btn-sm rounded-pill btn-outline-primary">Jadwal</a>
            <a href="{{ route('guru.edit', $teacher->id) }}" class="btn btn-sm rounded-pill btn-outline-info">Edit</a>

            <button onclick="handleDataDelete({{ $teacher->id }})" class="btn btn-sm rounded-pill btn-outline-danger">Delete</button>
            <form action="{{ route('guru.destroy', $teacher->id) }}" method="POST" id="form-delete-{{ $teacher->id }}">
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