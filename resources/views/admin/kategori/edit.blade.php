@extends('layouts.layout')
@section('title', 'Edit Kategori')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Kategori</h5>
                <form action="{{ route('kategori.update', [$kategori->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Kategori :</label>
                            <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control"
                                id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1" {{ $kategori->status === 1 ? 'selected' : '' }}>Aktif </option>
                                <option value="0" {{ $kategori->status === 0 ? 'selected' : '' }}>Tidak Aktif </option>
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
