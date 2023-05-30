@extends('layouts.app')

@section('title', 'Tambah Jadwal Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Tambah Jadwal Guru</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Tambah Jadwal Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('jadwal.store') }}" method="post">
            @csrf

            <input type="hidden" name="teacher_id" value="{{ $teacherId }}">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bx-plus-circle'></i> Tambah
                </button>
            </div>

            @include('layouts.alerts.validation')
            
            {{-- <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mata Pelajaran*</label>
                <input name="subject" type="text" class="form-control w-50" id="basic-default-fullname" placeholder="Mata Pelajaran"
                    required />
            </div> --}}

            {{-- <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Kelas*</label>
                <input name="class_grade" type="number" class="form-control w-50" id="basic-default-fullname"
                    placeholder="Kelas" required />
            </div> --}}

            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Hari</label>
                <select class="form-select w-50" id="exampleFormControlSelect1" aria-label="Default select example" name="day_id">
                    <option disabled selected>Pilih Hari</option>
                    @foreach ($days as $day)
                        <option value="{{ $day->id }}">{{ $day->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="html5-time-input" class="col-md-2 col-form-label">Waktu Checkin</label>
                <input class="form-control w-50" name='checkin_time' type="time" value="08:00:00" id="html5-time-input" />
            </div>

            <div class="mb-3">
                <label for="html5-time-input" class="col-md-2 col-form-label">Waktu Checkout</label>
                <input class="form-control w-50" name='checkout_time' type="time" value="16:00:00" id="html5-time-input" />
            </div>
        </form>
    </div>
</div>
@endsection