@extends('layouts.layout')
@section('title', 'Edit Menu')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Menu</h5>
                <form action="{{ route('menu.update', [$menu->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Menu :</label>
                            <input type="text" name="nama" value="{{ $menu->nama }}" class="form-control"
                                id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori :</label>
                            <select name="kategori_id" id="kategori" class="form-control select">
                                <option value="" disabled>-- Pilih Kategori -- </option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $menu->kategori_id === $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga :</label>
                            <input type="number" value="{{ $menu->harga }}" name="harga" class="form-control"
                                id="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok :</label>
                            <input type="number" value="{{ $menu->stok }}" name="stok" class="form-control"
                                id="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto :</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            <img src="/storage/{{ $menu->foto }}" class="mt-2" width="200px" alt="{{ $menu->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1" {{ $menu->status === 1 ? 'selected' : '' }}>Tersedia </option>
                                <option value="0" {{ $menu->status === 0 ? 'selected' : '' }}>Habis </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="history.goBack(-1)">
                            Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Simpan">
                    </div>
                </form>
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
