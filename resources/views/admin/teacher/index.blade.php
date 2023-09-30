@extends('layouts.app')

@section('title', 'Index Guru')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
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
    <div class="d-flex justify-content-between">
      <a href="{{ route('guru.create') }}" class="btn rounded-pill btn-primary">
        <i class='bx bx-plus-circle'></i> Tambah
      </a>

      <div class="d-flex justify-content-right gap-2">
        <button onclick="showUploadDialog()" class="btn rounded-pill btn-primary">
          <i class='bx bx-import' ></i> Import
        </button>
        
        <a href="{{ route('export.teacher') }}" class="btn rounded-pill btn-primary">
          <i class='bx bx-export'></i> Export
        </a>
      </div>
    </div>
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

    const showUploadDialog = async () => {
      const { value: file } = await Swal.fire({
        title: 'Select File',
        input: 'file',
        inputAttributes: {
          'accept': '.xlsx',
          'aria-label': 'Upload file'
        }
      }); 

      if (file) {
        let formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{!! csrf_token() !!}');

        fetch('{{ route('import.teacher') }}', {
          method: "POST", 
          body: formData
        }).then(response => {
          if (response.ok) {
            Swal.fire({
              title: 'Berhasil meng-import data',
              confirmButtonText: 'OK',
              icon: 'success',
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
          }

        });
      }
    }
    
    const handleDataDelete = (id) => {
        if (confirm('Hapus data ini?')) {
            document.getElementById(`form-delete-${id}`).submit();
        }
    } 
  </script>
@stop