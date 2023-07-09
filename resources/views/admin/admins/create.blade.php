@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<h4 class="fw-bold py-3 mb-4">Tambah Admin</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Tambah Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.store') }}" method="post">
            @csrf

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bx-plus-circle'></i> Tambah
                </button>
            </div>

            <div class="mb-3">
                @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                @endif
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama*</label>
                <input name="name" type="text" class="form-control w-50" id="basic-default-fullname" placeholder="Nama"
                    required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Email*</label>
                <input name="email" type="email" class="form-control w-50" id="basic-default-fullname" placeholder="Nama"
                    required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password*</label>
                <input name="password" type="text" class="form-control w-50" id="basic-default-fullname"
                    placeholder="Password" required />
            </div>
        </form>
    </div>
</div>
@endsection