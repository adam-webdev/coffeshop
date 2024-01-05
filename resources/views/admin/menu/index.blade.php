@extends('layouts.layout')
@section('title', 'Menu')

@section('css')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #fff;
            background-color: #8B4513;
            /* Warna coklat */
            border-color: #8B4513;
        }

        /* Gaya untuk warna pagination coklat pada hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff;
            background-color: #A0522D;
            /* Warna coklat tua pada hover */
            border-color: #A0522D;
        }

        /* Gaya untuk warna pagination coklat pada current page */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff;
            background-color: #A0522D;
            /* Warna coklat tua pada current page */
            border-color: #A0522D;
        }
    </style>
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Menu </h1>
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
                <h5 class="pt-4 pl-2">Tambah Menu</h5>
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Menu :</label>
                            <input type="text" name="nama" class="form-control id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori :</label>
                            <select name="kategori_id" id="kategori" class="form-control select">
                                <option value=""disabled>-- Pilih Kategori -- </option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga :</label>
                            <input type="number" name="harga" class="form-control" id="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok :</label>
                            <input type="number" name="stok" class="form-control" id="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto :</label>
                            <input type="file" name="foto" class="form-control  @error('foto') is-invalid @enderror""
                                id="foto" required>
                        </div>
                        @error('foto')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1">Tersedia </option>
                                <option value="0">Habis </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.go(-1)"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card p-4">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="table-responsive">
                        <table class="table  table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th width="2%">No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Stok </th>
                                    <th>Kategori </th>
                                    <th>Foto </th>
                                    <th>Status </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menu as $m)
                                    <tr align="center">
                                        <td width="2%">{{ $loop->iteration }}</td>
                                        <td>{{ $m->nama }}</td>
                                        <td>@currency($m->harga) </td>
                                        <td>{{ $m->stok }}</td>
                                        <td>{{ $m->kategori->nama }}</td>
                                        <td><img src="/storage/{{ $m->foto }}" width="80px"
                                                alt="{{ $m->nama }}"></td>
                                        <td width="15%">
                                            @php
                                                if ($m->status == 1) {
                                                    echo '<i style="color: green" class="fas fa-circle"></i> Tersedia';
                                                } else {
                                                    echo '<i style="color: red" class="fas fa-circle"></i> Habis';
                                                }
                                            @endphp
                                        </td>
                                        <td align="center" width="10%">
                                            @role('Admin')
                                                <a href="{{ route('menu.edit', [$m->id]) }}" data-toggle="tooltip"
                                                    title="Edit"
                                                    class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                    <i class="fas fa-edit fa-sm text-white"></i>
                                                </a>
                                                <a href="/menu/hapus/{{ $m->id }}" data-toggle="tooltip" title="Hapus"
                                                    onclick="return confirm('Yakin Ingin menghapus data?')"
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

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: '100%'
            });
            $('#example').DataTable();

        });
    </script>
@endsection
