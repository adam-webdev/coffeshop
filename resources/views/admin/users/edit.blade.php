@extends('layouts.layout')
@section('title', 'Edit Pegawai')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Data Pegawai</h5>
                <form action="{{ route('user.update', [$user->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Pegawai :</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No Hp :</label>
                            <input type="number" name="no_hp" value="{{ $user->no_hp }}" class="form-control"
                                id="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jk" class="form-control">
                                <option value=""disabled>-- Pilih Jenis Kelamin -- </option>
                                <option value="Laki-laki" {{ $user->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki </option>
                                <option value="Perempuan"{{ $user->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan </option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="roles">Roles :</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value=""disabled>-- Pilih Roles -- </option>
                                <option value="Admin" {{ $user->roles->pluck('name') === 'Admin' ? 'selected' : '' }}>
                                    Admin </option>
                                <option value="Dapur" {{ $user->roles->pluck('name') === 'Dapur' ? 'selected' : '' }}>
                                    Dapur </option>
                                <option value="Kasir" {{ $user->roles->pluck('name') === 'Kasir' ? 'selected' : '' }}>
                                    Kasir </option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="roles">Roles :</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value=""disabled>-- Pilih Roles -- </option>
                                @foreach ($roles as $i => $name)
                                    <option value="{{ $name }}"
                                        {{ $user->roles->pluck('name')[0] === $name ? 'selected' : '' }}>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-warning text-sm"><small>Biarkan kosong jika tidak ingin merubah password
                            </small></span>
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
{{-- @section('scripts')
     <script>
        $(document).ready(function() {
            $('.select').select2({
                tags:true,
                width:'resolve'
            });
        });
    </script>
@endsection --}}
