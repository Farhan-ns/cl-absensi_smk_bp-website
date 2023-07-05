@extends('layouts.app')

@section('title', 'Index Guru')

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
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Nomor Telepon</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($teachers as $teacher)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $teacher->name }}</td>
          <td>{{ $teacher->phone ?? '-' }}</td>
          <td>{{ $teacher->email ?? '-' }}</td>
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
    <script>
        const handleDataDelete = (id) => {
            if (confirm('Hapus data ini?')) {
                document.getElementById(`form-delete-${id}`).submit();
            }
        } 
    </script>
@stop