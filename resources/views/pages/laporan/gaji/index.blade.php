@extends('layouts.app')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Laporan Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class='form-group'>
                                <label for='karyawan_id'>Karyawan</label>
                                <select name='karyawan_id' id='karyawan_id'
                                    class='form-control @error('karyawan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Karyawan</option>
                                    @foreach ($data_karyawan as $karyawan)
                                        <option @selected($karyawan->id == old('karyawan_id')) value='{{ $karyawan->id }}'>
                                            {{ $karyawan->nama . ' | ' . 'NIP : ' . $item->nip }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
