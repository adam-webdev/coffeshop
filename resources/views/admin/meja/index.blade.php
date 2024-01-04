@extends('layouts.layout')
@section('title', 'Meja')


@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Meja </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Tambah Meja</h5>
                <form action="{{ route('meja.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Meja :</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kursi">Kursi :</label>
                            <input type="number" name="kursi" class="form-control" id="kursi" required>
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1">Terisi </option>
                                <option value="0">Kosong </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr align="center">
                                        <th width="2%">No</th>
                                        <th>Nama Meja</th>
                                        <th>Kursi</th>
                                        <th width="15%">Status </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meja as $m)
                                        <tr align="center">
                                            <td width="2%">{{ $loop->iteration }}</td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->kursi }}</td>
                                            <td width="15%">
                                                @php
                                                    if ($m->status == 0) {
                                                        echo '<i style="color: green" class="fas fa-circle"></i> Kosong';
                                                    } else {
                                                        echo '<i style="color: red" class="fas fa-circle"></i> Terisi';
                                                    }
                                                @endphp
                                            </td>
                                            <td align="center" width="10%">
                                                @role('Admin')
                                                    <a href="{{ route('meja.edit', [$m->id]) }}" data-toggle="tooltip"
                                                        title="Edit"
                                                        class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                        <i class="fas fa-edit fa-sm text-white"></i>
                                                    </a>
                                                    <a href="/meja/hapus/{{ $m->id }}" data-toggle="tooltip"
                                                        title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                        class="d-none d-sm-inline-block btn btn-sm text-white shadow-sm"
                                                        style="background-color: #663300;">
                                                        <i class="fas fa-trash-alt fa-sm text-white"></i>
                                                    </a>
                                                @endrole
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
    </div>

@endsection
