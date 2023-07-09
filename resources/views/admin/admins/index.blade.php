@extends('layouts.app')

@section('title', 'Index Admin')

@section('content')
<h4 class="fw-bold py-3 mb-4">Index Admin</h4>

<div class="card">

  @if (Session::has('message'))
  
  <div class="alert alert-primary alert-dismissible" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  @endif

  <h5 class="card-header">
    <a href="{{ route('admin.create') }}" class="btn rounded-pill btn-primary">
      <i class='bx bx-plus-circle'></i> Tambah
    </a>
  </h5>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @php $i = 1; @endphp
        @foreach ($admins as $admin)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ $admin->role->name }}</td>
          <td>
            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm rounded-pill btn-outline-info">Edit</a>

            <button onclick="handleDataDelete({{ $admin->id }})" class="btn btn-sm rounded-pill btn-outline-danger">Delete</button>
            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" id="form-delete-{{ $admin->id }}">
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