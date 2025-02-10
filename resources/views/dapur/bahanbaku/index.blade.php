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
            <div class="card">
                <h5 class="pt-4 pl-2">Tambah Bahan Baku</h5>
                <form action="{{ route('bahan-baku.store') }}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Bahan Baku :</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="harga">Harga :</label>
                                <input type="number" name="harga" class="form-control" id="harga" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="stok">Stok :</label>
                                <input type="number" name="stok" class="form-control" id="jumlah" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="minimal">Minimal Stok :</label>
                                <input type="number" name="minimal_stok" class="form-control" id="minimal" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="maximal">Maximal Stok :</label>
                                <input type="number" name="maximal_stok" class="form-control" id="maximal" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="lead_time">Lead Time :</label>
                                <input type="text" name="lead_time" class="form-control" id="lead_time" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="rata_rata_stok_pertahun">Rata Rata Stok Pertahun :</label>
                                <input type="text" name="rata_rata_stok_pertahun" class="form-control" id="rata_rata_stok_pertahun" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nohp">Status :</label>
                                <select name="status" id="status" class="form-control">
                                    <option value=""disabled>-- Pilih Status -- </option>
                                    <option value="1">Aktif </option>
                                    <option value="0">Tidak Aktif </option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.go(-1)"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
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
                                    <th>Min Stok </th>
                                    <th>Max Stok </th>
                                    <th>Satuan </th>
                                    <th>Harga </th>
                                    <th>Status </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahanbaku as $b)
                                    <tr align="center" @php echo ($b->stok < $b->minimal_stok) ? 'style="background-color: #ffcccc;"' : ''; @endphp >
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->nama }}
                                            @if ($b->stok < $b->minimal_stok)
                                            <br><a href="{{route('orderbahanbaku.now',[$b->id])}}" class="btn btn-sm btn-success">Order <i  class="fas fa-arrow-right"></i> </a>
                                            @endif
                                        </td>
                                        <td>{{ $b->stok }}</td>
                                        <td>{{ $b->minimal_stok }}</td>
                                        <td>{{ $b->maximal_stok }}</td>
                                        <td>{{ $b->satuan }}</td>
                                        <td>@currency($b->harga)</td>
                                        <td width="15%">
                                            @php
                                                if ($b->status == 1 && $b->stok >= $b->minimal_stok) {
                                                    echo '<i style="color: green" class="fas fa-circle"></i> Tersedia';
                                                } else {
                                                    echo '<i style="color: red" class="fas fa-circle"></i> Tidak Tersedia';
                                                }
                                            @endphp
                                        </td>
                                        <td align="center" width="15%">
                                            {{-- @role('Admin') --}}
                                            <a href="{{ route('bahan-baku.show', [$b->id]) }}" data-toggle="tooltip"
                                                title="Detail"
                                                class=" mt-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                <i class="fas fa-eye fa-sm text-white-50"></i>
                                            </a>
                                            <a href="{{ route('bahan-baku.edit', [$b->id]) }}" data-toggle="tooltip"
                                                title="Edit"
                                                class=" mt-2 d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </a>
                                            <a href="/bahan-baku/hapus/{{ $b->id }}" data-toggle="tooltip"
                                                title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                class="mt-2 d-sm-inline-block btn btn-sm btn-danger shadow-sm"
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
