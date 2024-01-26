@extends('layouts.layout')
@section('title', 'Edit Meja')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Meja</h5>
                <form action="{{ route('meja.update', [$meja->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Meja :</label>
                            <input type="text" name="nama" value="{{ $meja->nama }}" class="form-control id="nama"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="kursi">Kursi :</label>
                            <input type="number" name="kursi" value="{{ $meja->kursi }}" class="form-control"
                                id="kursi" required>
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1" {{ $meja->status === 1 ? 'selected' : '' }}>Terisi </option>
                                <option value="0" {{ $meja->status === 0 ? 'selected' : '' }}>Kosong </option>
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
