@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Bahan Baku </h1>
        <!-- Button trigger modal -->


    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Tambah Bahan Baku</h5>
                <form action="{{ route('bahan-baku.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Bahan Baku :</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>

                        <div class="form-group ">
                            <label for="harga">Harga :</label>
                            <input type="number" name="harga" class="form-control" id="harga" required>
                        </div>
                        <div class="form-group ">
                            <label for="stok">Stok :</label>
                            <input type="number" name="stok" class="form-control" id="jumlah" required>
                        </div>
                        <div class="form-group ">
                            <label for="minimal">Minimal Stok :</label>
                            <input type="number" name="minimal_stok" class="form-control" id="minimal" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang :</label>
                            <select style="width:100%" name="satuan" id="satuan" class="form-control select" required>
                                <option selected disabled value="">-- Pilih Satuan Barang --</option>
                                <option value="Gram">Gram</option>
                                <option value="Kg">Kg</option>
                                <option value="Liter">Liter</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Box">Box</option>
                                <option value="Sachet">Sachet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1">Tersedia </option>
                                <option value="0">Tidak Ada </option>
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
                        <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    </th>
                                    <th>Nama </th>
                                    <th>Stok </th>
                                    <th>Minimal Stok </th>
                                    <th>Harga </th>
                                    <th>Satuan </th>
                                    <th>Status </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahanbaku as $b)
                                    <tr align="center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->nama }}</td>
                                        <td>{{ $b->stok }}</td>
                                        <td>{{ $b->minimal_stok }}</td>
                                        <td>@currency($b->harga)</td>
                                        <td>{{ $b->satuan }}</td>
                                        <td width="15%">
                                            @php
                                                if ($b->status == 1) {
                                                    echo '<i style="color: green" class="fas fa-circle"></i> Tersedia';
                                                } else {
                                                    echo '<i style="color: red" class="fas fa-circle"></i> Tidak Ada';
                                                }
                                            @endphp
                                        </td>
                                        <td align="center" width="10%">
                                            {{-- @role('Admin') --}}
                                            <a href="{{ route('bahan-baku.edit', [$b->id]) }}" data-toggle="tooltip"
                                                title="Edit"
                                                class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </a>
                                            <a href="/bahan-baku/hapus/{{ $b->id }}" data-toggle="tooltip"
                                                title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                style="background-color: #663300;">
                                                <i class="fas fa-trash-alt fa-sm text-white-50"></i>
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
