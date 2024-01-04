@extends('layouts.layout')
@section('title', 'Bill of material')
@section('content')
    @include('sweetalert::alert')
    <div class="card p-4 ">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bill Of Materials </h1>
            <!-- Button trigger modal -->
            @role('Admin')
                <a href="{{ route('billofmaterial.create') }}">
                    <button type="button" class="btn btn-primary">
                        + Tambah
                    </button>
                </a>
            @endrole
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-str6iped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No </th>
                                <th>Nama FG </th>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bom as $b)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->finishgood->nama_fg }}</td>
                                    <td>{{ $b->bahanbaku->nama_material }}</td>
                                    <td>{{ $b->jumlah }}</td>
                                    <td>{{ $b->bahanbaku->satuan }}</td>
                                    <td align="center" width="10%">
                                        @role('Admin')
                                            <a href="{{ route('billofmaterial.edit', [$b->id]) }}" data-toggle="tooltip"
                                                title="Edit"
                                                class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </a>
                                            <a href="/billofmaterial/hapus/{{ $b->id }}" data-toggle="tooltip"
                                                title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                <i class="fas fa-trash-alt fa-sm text-white-50"></i>
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
@endsection
