@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Ganti Password</h4>

<div class="card">
    
    @if (Session::has('message'))
  
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif

    <div class="card-header">
        {{-- <h5>Tambah Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('change-password.post') }}" method="post">
            @csrf

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bxs-save'></i> Ubah
                </button>
            </div>

            <div class="mb-3">
                @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password Sekarang*</label>
                <input name="password" type="password" class="form-control w-50" id="basic-default-fullname"
                    placeholder="Password" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password Baru*</label>
                <input name="new_password" type="password" class="form-control w-50" id="basic-default-fullname"
                    placeholder="Password" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Konfimasi Password Baru*</label>
                <input name="new_password_confirmation" type="password" class="form-control w-50" id="basic-default-fullname"
                    placeholder="Password" required />
            </div> 
        </form>
    </div>
</div>
@endsection