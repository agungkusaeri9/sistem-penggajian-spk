@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>SPK Alternatif Kriteria</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('spk-alternatif-kriteria.store') }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table nowrap table-bordered">
                                    <tr>
                                        <th rowspan="2" colspan="2">Karyawan</th>
                                        <th colspan="{{ count($data_kriteria) }}" class="text-center">Kriteria</th>
                                    </tr>
                                    <tr>
                                        @foreach ($data_kriteria as $kriteria)
                                            <th class="text-center">{{ $kriteria->nama }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach ($data_karyawan as $karyawan)
                                        <tr>
                                            <input type="hidden" name="karyawan_id[]" value="{{ $karyawan->id }}">
                                            <td colspan="2">
                                                {{ $karyawan->nama }}
                                            </td>
                                            @foreach ($data_kriteria as $kriteria2)
                                                <td>
                                                    <input type="hidden"
                                                        name="spk_kriteria_id_karawan_id_{{ $karyawan->id }}[]"
                                                        value="{{ $kriteria2->id }}">
                                                    <div class='form-group'>
                                                        <select name='spk_kriteria_detail_id_karyawan_{{ $karyawan->id }}[]'
                                                            id='spk_kriteria_detail_id'
                                                            class='form-control @error('spk_kriteria_detail_id') is-invalid @enderror'>
                                                            <option value='' selected disabled>Pilih
                                                                {{ $kriteria2->nama }}</option>
                                                            @foreach ($kriteria2->details as $detail)
                                                                <option @selected($detail->id == old('spk_kriteria_detail_id'))
                                                                    value='{{ $detail->id }}'>{{ $detail->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="form-group">
                                <button class="btn float-right btn-primary">Get Normalisasi</button>
                            </div>
                        </form>
                        @if ($data_normalisasi)
                            <form action="javascript:void(0)" method="post" class="needs-validation" novalidate=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table nowrap table-bordered">
                                        <tr>
                                            <th rowspan="2" colspan="2">Karyawan</th>
                                            <th colspan="{{ count($data_kriteria) }}" class="text-center">Kriteria</th>
                                        </tr>
                                        <tr>
                                            @foreach ($data_kriteria as $kriteria)
                                                <th class="text-center">
                                                    {{ $kriteria->nama . ' (' . getJenis($kriteria->id) . ')' }}
                                                </th>
                                            @endforeach
                                        </tr>
                                        @foreach ($data_normalisasi as $normalisasi)
                                            <tr>
                                                <input type="hidden" name="karyawan_id[]" value="{{ $normalisasi->id }}">
                                                <td colspan="2">
                                                    {{ $normalisasi->karyawan->nama }}
                                                </td>
                                                @foreach ($data_kriteria as $kriteria2)
                                                    <td>
                                                        {{ getNilai($normalisasi->karyawan_id, $kriteria2->id) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="
                                   2">Pembagi</th>
                                            @foreach ($data_kriteria as $krite)
                                                <td>{{ getPembagi($krite->id) }}</td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <form action="javascript:void(0)" method="post" class="needs-validation" novalidate=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table nowrap table-bordered">
                                        <tr>
                                            <th rowspan="2" colspan="2">Karyawan</th>
                                            <th colspan="{{ count($data_kriteria) }}" class="text-center">Kriteria</th>
                                        </tr>
                                        <tr>
                                            @foreach ($data_kriteria as $kriteria)
                                                <th class="text-center">
                                                    {{ $kriteria->nama . ' (' . getJenis($kriteria->id) . ')' }}
                                                </th>
                                            @endforeach
                                        </tr>
                                        @foreach ($data_normalisasi as $normalisasi)
                                            <tr>
                                                <input type="hidden" name="karyawan_id[]" value="{{ $normalisasi->id }}">
                                                <td colspan="2">
                                                    {{ $normalisasi->karyawan->nama }}
                                                </td>
                                                @foreach ($data_kriteria as $kriteria2)
                                                    <td>
                                                        {{ getNormalisasi($normalisasi->karyawan_id, $kriteria2->id) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </form>
                            <form action="javascript:void(0)" method="post" class="needs-validation" novalidate=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table nowrap table-bordered">
                                        <tr>
                                            <th colspan="">Karyawan</th>
                                            <th colspan="" class="text-center">Kriteria</th>
                                            <th>Ranking</th>
                                        </tr>
                                        @foreach ($data_normalisasi as $normalisasi)
                                            <tr>
                                                <td>
                                                    {{ $normalisasi->karyawan->nama }}
                                                </td>
                                                <td>{{ getTotalNilai($normalisasi->karyawan_id) }}</td>
                                                <td>
                                                    {{-- {{ getAllRanking($normalisasi->karyawan_id) }} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </form>
                        @endif
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
