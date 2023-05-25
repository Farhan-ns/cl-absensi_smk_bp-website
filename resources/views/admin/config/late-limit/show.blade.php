@extends('layouts.app')

@section('title', 'Limit Keterlambatan')

@section('content')
<h4 class="fw-bold py-3 mb-4">Limit Keterlambatan</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Limit Keterlambatan</h5> --}}
    </div>

    <div class="card-body">
        @if (Session::has('message'))

        <div class="alert alert-primary alert-dismissible" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif

        <form action="{{ route('limit.update') }}" method="post">
            @csrf

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
                <label class="form-label" for="basic-default-fullname">Batas Keterlambatan (Menit)</label>
                <input name="late_limit" type="text" class="form-control w-50" placeholder="30" value="{{ $lateLimit }}"
                    required />
            </div>
        </form>
    </div>
</div>
@endsection