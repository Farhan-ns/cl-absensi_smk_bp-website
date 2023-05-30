@extends('layouts.app')

@section('title', 'IP Absensi')

@section('content')
<h4 class="fw-bold py-3 mb-4">IP Absensi</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>IP Absensi</h5> --}}
    </div>

    <div class="card-body">
        @include('layouts.alerts.session')

        <form action="{{ route('allowed-ip.update') }}" method="post">
            @csrf

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn rounded-pill btn-primary">
                    <i class='bx bx-save'></i> Simpan
                </button>
            </div>

            @include('layouts.alerts.validation')

            <div class="row">
                <div class="col">
                    <label class="form-label" for="basic-default-fullname">Alamat IP</label>
                    <input name="ip_address_1" type="number" class="form-control" placeholder="000" value="{{ $expAllowedIp[0] === '*' ? 0 : $expAllowedIp[0] }}"
                        required />
                </div>
                <div class="col">
                    <label class="form-label" for="basic-default-fullname">*</label>
                    <input name="ip_address_2" type="number" class="form-control" placeholder="000" value="{{ $expAllowedIp[1] === '*' ? 0 : $expAllowedIp[1] }}"
                        required />
                </div>
                <div class="col">
                    <label class="form-label" for="basic-default-fullname">*</label>
                    <input name="ip_address_3" type="number" class="form-control" placeholder="000" value="{{ $expAllowedIp[2] === '*' ? 0 : $expAllowedIp[2] }}"
                        required />
                </div>
                <div class="col">
                    <label class="form-label" for="basic-default-fullname">*</label>
                    <input name="ip_address_4" type="number" class="form-control" placeholder="000" value="{{ $expAllowedIp[3] === '*' ? 0 : $expAllowedIp[3] }}"
                        required />
                </div>
            </div>

        </form>
    </div>
</div>
@endsection