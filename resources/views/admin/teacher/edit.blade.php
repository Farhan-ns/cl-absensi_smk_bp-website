@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Edit Guru</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Edit Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('guru.update', $teacher->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bx-save'></i> Simpan
                </button>
            </div>

            <div class="mb-3">
                @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama*</label>
                <input name="name" type="text" class="form-control w-50" value="{{ old('name') ?? $teacher->name }}" placeholder="Nama"
                    required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Kelas</label>
                <input name="class_grade" type="text" class="form-control w-50" value="{{ old('class_grade') ?? $teacher->class_grade ?? '' }}" placeholder="Kelas"
                    required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mata Pelajaran</label>
                <input name="subject" type="text" class="form-control w-50" value="{{ old('subject') ?? $teacher->subject ?? '' }}" placeholder="Mata Pelajaran"
                    required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password*</label>
                <input name="password" type="text" class="form-control w-50" value=""
                    placeholder="Password"/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                <input name="birthdate" type="date" class="form-control w-50" value="{{ old('birthdate') ?? $teacher->birthdate }}"
                    placeholder="Tanggal Lahir" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nomor Telepon</label>
                <input name="phone" type="number" class="form-control w-50" value="{{ old('phone') ?? $teacher->phone }}"
                    placeholder="Nomor Telepon" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input name="email" type="email" class="form-control w-50" value="{{ old('email') ?? $teacher->email }}"
                    placeholder="Email" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Alamat Rumah</label>
                <input name="address" type="text" class="form-control w-50" value="{{ old('address') ?? $teacher->address }}"
                    placeholder="Alamat Rumah" />
            </div>

        </form>
    </div>
</div>
@endsection