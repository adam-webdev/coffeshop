@extends('layouts.layout')
@section('title', 'Komposisi Menu')

@section('css')
    <style>
        .btn-success {
            background: #663300 !important;
            color: white;
        }
    </style>
@endsection
@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Komposisi Menu </h1>
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
                <h5 class="pt-4 pl-2">Tambah Komposisi Menu</h5>
                <form action="{{ route('ingredients.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Menu :</label>
                            <select name="menu_id" id="menu" class="form-control select">
                                <option value=""disabled>-- Pilih Menu -- </option>
                                @foreach ($menu as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->nama }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row add-data">
                            <div class="col-md-7">
                                <label for="bb">Bahan :</label>
                                <select name="bahanbaku_id[]" id="bb" class="form-control select">
                                    <option value=""disabled>-- Bahan Baku -- </option>
                                    @foreach ($bahanbaku as $bb)
                                        <option value="{{ $bb->id }}">{{ $bb->nama }} <small>
                                                ({{ $bb->satuan }})
                                            </small></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                            </div>

                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success"><i
                                        class="fas fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="jumlah">Untuk Berapa Porsi :</label>
                            <input type="number" name="porsi" class="form-control" id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan:</label>
                            <textarea name="keterangan" class="form-control" id="keterangan" rows="4"></textarea>
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
                                    <th>Menu</th>
                                    <th>Bahan Baku</th>
                                    <th>Satuan </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingredients as $i)
                                    <tr align="center">
                                        <td width="2%">{{ $loop->iteration }}</td>
                                        <td>{{ $i->menu->nama }}</td>
                                        <td>
                                            <div class="flex">
                                                <span>{{ $i->bahanbaku->nama }}</span>
                                                <span>{{ $i->jumlah }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $i->bahanbaku->satuan }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($bbt->tanggal)->isoFormat('dddd, D MMMM Y') }}</td> --}}

                                        <td align="center" width="10%">
                                            {{-- @role('Admin') --}}
                                            {{-- <a href="{{ route('bahanbaku-masuk.edit', [$bbm->id]) }}" data-toggle="tooltip"
                                                title="Edit"
                                                class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                <i class="fas fa-edit fa-sm text-white"></i>
                                            </a> --}}
                                            <a href="/ingredients/hapus/{{ $i->id }}" data-toggle="tooltip"
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
            $('.selectt').select2({
                tags: true,
                width: '100%'
            });


            $(add).on('click', function() {
                $('.add-data').append(` <div class="form-group row child px-3">
                    <div class="col-md-7">
                        <label for="bb"> Bahan Baku :</label>
                        <select type="text" name="bahanbaku_id[]" class="form-control selectt" id="bb" required>
                            <option value="" disabled>--Bahan Baku--</option>
                                    @foreach ($bahanbaku as $bb)
                                        <option value="{{ $bb->id }}">{{ $bb->nama }} <small> ({{ $bb->satuan }})</small></option>
                                    @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah">Jumlah :</label>
                        <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                    </div>
                    <div class="col-md-2 add">
                        <label>Aksi :</label>
                        <button id="add" name="add" type="button" class="btn btn-sm btn-danger delete-child btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    </div>`)
            })

            $(document).on('click', '.delete-child', function() {
                $(this).parents('.child').remove()
            })

        })
    </script>

@endsection
