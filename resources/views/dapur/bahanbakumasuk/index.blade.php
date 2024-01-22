@extends('layouts.layout')
@section('title', 'Bahan Baku Terpakai')


@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bahan Baku Terpakai </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-md-4 mt-2">
            <div class="card ">
                <h5 class="pt-4 pl-2">Tambah Bahan Baku Terpakai</h5>
                <form action="{{ route('bahanbaku-masuk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bahan_baku">Bahan Baku :</label>
                            <select name="bahanbaku_id" id="bahan_baku" class="form-control select">
                                <option value=""disabled>-- Pilih Bahan Baku -- </option>
                                @foreach ($bahanbaku as $bb)
                                    <option value="{{ $bb->id }}">{{ $bb->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal :</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.go(-1)"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8 mt-2">
            <div class="card p-4">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="table-responsive">
                        <table class="table  table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th width="2%">No</th>
                                    <th>Nama Bahan Baku</th>
                                    <th>Jumlah</th>
                                    <th>Stok Bahan Baku</th>
                                    <th>Tanggal Masuk </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahanbakumasuk as $bbm)
                                    <tr align="center">
                                        <td width="2%">{{ $loop->iteration }}</td>
                                        <td>{{ $bbm->bahanbaku->nama }}</td>
                                        <td>{{ $bbm->jumlah }}</td>
                                        <td>{{ $bbm->bahanbaku->stok }}</td>
                                        <td>{{ \Carbon\Carbon::parse($bbm->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>

                                        <td align="center" width="10%">
                                            {{-- @role('Admin') --}}
                                            {{-- <a href="{{ route('bahanbaku-masuk.edit', [$bbm->id]) }}" data-toggle="tooltip"
                                                title="Edit"
                                                class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                <i class="fas fa-edit fa-sm text-white"></i>
                                            </a> --}}
                                            <a href="/bahanbaku-masuk/hapus/{{ $bbm->id }}" data-toggle="tooltip"
                                                title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                class="mt-2 d-sm-inline-block btn btn-sm text-white shadow-sm"
                                                style="background-color: #663300;">
                                                <i class="fas fa-trash-alt fa-sm text-white"></i>
                                            </a>
                                            {{-- @endrole --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: '100%'
            });
        });
    </script>
@endsection
