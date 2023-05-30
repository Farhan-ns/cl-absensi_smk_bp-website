@extends('layouts.app')

@section('title', 'Edit Jadwal Guru')

@section('content')
<h4 class="fw-bold py-3 mb-4">Edit Jadwal Guru</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Tambah Jadwal Guru</h5> --}}
    </div>

    <div class="card-body">
        <form action="{{ route('jadwal.update', $teacherId) }}" method="post">
            @method('PUT')
            @csrf

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bx-save'></i> Simpan
                </button>
            </div>

            @include('layouts.alerts.validation')
            
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Hari</label>
                <select class="form-select w-50" id="exampleFormControlSelect1" aria-label="Default select example" name="day_id">
                    <option disabled selected>Pilih Hari</option>
                    @foreach ($days as $day)
                        <option value="{{ $day->id }}" @if ($schedule->day_id === $day->id) selected @endif>
                            {{ $day->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="html5-time-input" class="col-md-2 col-form-label">Waktu Checkin</label>
                <input class="form-control w-50" name='checkin_time' type="time" value="{{ $schedule->checkin_time }}" id="html5-time-input" />
            </div>

            <div class="mb-3">
                <label for="html5-time-input" class="col-md-2 col-form-label">Waktu Checkout</label>
                <input class="form-control w-50" name='checkout_time' type="time" value="{{ $schedule->checkout_time }}" id="html5-time-input" />
            </div>
        </form>
    </div>
</div>
@endsection