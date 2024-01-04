@extends('layouts.layout')
@section('title', 'Bahan Baku Masuk')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Bahan Baku Masuk</h5>
                <form action="{{ route('bahanbakumasuk.update', [$bahanbakumasuk->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bahan_baku">Bahan Baku :</label>
                            <select name="bahanbaku_id" id="bahan_baku" class="form-control select">
                                <option value=""disabled>-- Pilih Bahan Baku -- </option>
                                @foreach ($bahanbaku as $bb)
                                    <option value="{{ $bb->id }}"
                                        {{ $bahanbakumasuk->bahanbaku_id === $bb->id ? 'selected' : '' }}>
                                        {{ $bb->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah :</label>
                            <input type="number" name="jumlah" value="{{ $bahanbakumasuk->jumlah }}" class="form-control"
                                id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal :</label>
                            <input type="date" name="tanggal" value="{{ $bahanbakumasuk->tanggal }}" class="form-control"
                                id="tanggal" required>
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
