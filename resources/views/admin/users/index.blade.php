@extends('layouts.layout')
@section('title', 'Pegawai')


@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pegawai </h1>
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
                <h5 class="pt-4 pl-2">Tambah Data Pegawai</h5>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Pegawai :</label>
                            <input type="text" name="name" class="form-control" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No Hp :</label>
                            <input type="number" name="no_hp" class="form-control" id="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis" class="form-control">
                                <option value=""disabled>-- Pilih Jenis Kelamin -- </option>
                                <option value="Laki-laki">Laki-laki </option>
                                <option value="Perempuan">Perempuan </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles :</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value=""disabled>-- Pilih Roles -- </option>
                                @foreach ($roles as $i => $name)
                                    <option value="{{ $name }}">{{ $name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8 mt-2">
            <div class="card">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr align="center">
                                        <th width="2%">No</th>
                                        <th>Nama </th>
                                        <th>Email </th>
                                        <th>No HP </th>
                                        <th>Jenis Kelamin </th>
                                        <th>Roles</th>
                                        {{-- <th width="15%">Status </th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $u)
                                        <tr align="center">
                                            <td width="2%">{{ $loop->iteration }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->no_hp }}</td>
                                            <td>{{ $u->jenis_kelamin }}</td>
                                            <td>{{ $u->roles->pluck('name')[0] }}</td>
                                            {{-- <td width="15%">
                                                @php
                                                    if ($m->status == 0) {
                                                        echo '<i style="color: green" class="fas fa-circle"></i> Kosong';
                                                    } else {
                                                        echo '<i style="color: red" class="fas fa-circle"></i> Terisi';
                                                    }
                                                @endphp
                                            </td> --}}
                                            <td align="center" width="10%">
                                                @role('Admin')
                                                    <a href="{{ route('user.edit', [$u->id]) }}" data-toggle="tooltip"
                                                        title="Edit"
                                                        class="mt-2  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                        <i class="fas fa-edit fa-sm text-white"></i>
                                                    </a>
                                                    <a href="/user/hapus/{{ $u->id }}" data-toggle="tooltip"
                                                        title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                        class="mt-2 d-sm-inline-block btn btn-sm text-white shadow-sm"
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
