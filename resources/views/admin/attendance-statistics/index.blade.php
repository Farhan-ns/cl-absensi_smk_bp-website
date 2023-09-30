@extends('layouts.app')

@section('title', 'Statistik Kehadiran')

@section('content')
<h4 class="fw-bold py-3 mb-4">Statistik Kehadiran</h4>

<div class="card">
    <div class="card-header">
        {{-- <h5>Statistik Kehadiran</h5> --}}
    </div>

    <div class="card-body">
        @include('layouts.alerts.session')

        <form action="{{ route('attendance.statistics.post') }}" method="POST">
            @csrf

            {{-- <div class="d-flex justify-content-between">
                
                <div><label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                    <input name="birthdate" type="date" class="form-control w-50" id="basic-default-fullname" value="{{ old('birthdate') }}"
                        placeholder="Tanggal Lahir" /></div>
                
                <div class="d-flex justify-content-right gap-2">
                    <button type="submit" class="btn rounded-pill btn-primary">
                        <i class='bx bx-save'></i> Submit
                    </button>
                </div>
            </div> --}}

            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12">
                    <canvas id="chart"></canvas>
                </div>
                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label" for="teacherPicker">Guru</label>
                        <select class="form-select" name="guru" id="teacherPicker">
                            <option value="-1" @if ($selectedTeacher < 0 ?? false) selected @endif>Semua Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if ($teacher->id == $selectedTeacher) selected @endif>
                                    {{ $teacher->name }} 
                                </option>
                            @endforeach
                        </select>
                        {{-- <input name="birthdate" type="date" class="form-control w-50" id="basic-default-fullname" value="{{ old('birthdate') }}"
                            placeholder="Tanggal Lahir" /> --}}
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="monthPicker">Bulan</label>
                                <select class="form-select" name="bulan" id="monthPicker">
                                    @foreach ($months as $id => $month)
                                        <option value="{{ $id }}" @if ($selectedMonth == $id) selected @endif>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="yearPicker">Tahun</label>
                                <select class="form-select" name="tahun" id="yearPicker">
                                    @for ($i = 2023; $i < 2100; $i++)
                                    <option value="{{ $i }}"  @if ($selectedYear == $i) selected @endif>
                                        {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        {{-- <input name="birthdate" type="date" class="form-control w-50" id="basic-default-fullname" value="{{ old('birthdate') }}"
                            placeholder="Tanggal Lahir" /> --}}
                    </div>
                    <div>
                        <button type="submit" class="btn rounded-pill btn-primary">
                            <i class='bx bx-save'></i> Submit
                        </button>
                    </div>
                </div>
            </div>
            

            @include('layouts.alerts.validation')

        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chart');
    const data = {
        labels: [
            'Hadir',
            'Terlambat',
            'Tidak Hadir'
        ],
        datasets: [{
            label: 'Persentase',
            data: [
                '{{ $attendancePercentage }}',
                '{{ $latePercentage }}', 
                '{{ $restPercentage }}', 
            ],
            backgroundColor: [
            'rgb(95, 97, 230)',
            'rgb(255, 99, 132)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: data,
    });
</script>

@endsection