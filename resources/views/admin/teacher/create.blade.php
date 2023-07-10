@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Tambah Guru</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Tambah Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('guru.store') }}" method="post">
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
                <input name="name" type="text" class="form-control w-50" id="basic-default-fullname"  value="{{ old('name') }}"
                placeholder="Nama" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Kelas</label>
                <input name="class_grade" type="text" class="form-control w-50" value="{{ old('class_grade') }}" placeholder="Kelas"/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mata Pelajaran</label>
                <input name="subject" type="text" class="form-control w-50" value="{{ old('subject') }}" placeholder="Mata Pelajaran" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password*</label>
                <input name="password" type="text" class="form-control w-50" id="basic-default-fullname" value="{{ old('name') }}"
                    placeholder="Password" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                <input name="birthdate" type="date" class="form-control w-50" id="basic-default-fullname" value="{{ old('birthdate') }}"
                    placeholder="Tanggal Lahir" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nomor Telepon</label>
                <input name="phone" type="number" class="form-control w-50" id="basic-default-fullname" value="{{ old('phone') }}"
                    placeholder="Nomor Telepon" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input name="email" type="email" class="form-control w-50" id="basic-default-fullname" value="{{ old('email') }}"
                    placeholder="Email" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Alamat Rumah</label>
                <input name="address" type="text" class="form-control w-50" id="basic-default-fullname" value="{{ old('address') }}"
                    placeholder="Alamat Rumah" />
            </div>

        </form>
    </div>
</div>
@endsection