@extends('layouts.layout')
@section('title', 'Order Bahan Baku ')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Order Bahan Baku </h5>
                <form action="{{ route('orderbahanbaku.update', [$orderbahanbaku->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bahan_baku">Order Bahan Baku :</label>
                            <select name="bahanbaku_id" id="bahan_baku" class="form-control select">
                                <option value=""disabled>-- Pilih Bahan Baku -- </option>
                                @foreach ($bahanbaku as $bb)
                                    <option value="{{ $bb->id }}"
                                        {{ $orderbahanbaku->bahanbaku_id === $bb->id ? 'selected' : '' }}>
                                        {{ $bb->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah :</label>
                            <input type="number" name="jumlah" value="{{ $orderbahanbaku->jumlah }}" class="form-control"
                                id="jumlah" required>
                        </div>
                       <div class="form-group">
                            <label for="harga"> Harga :</label>
                            <input type="number" name="harga" class="form-control" value="{{ $orderbahanbaku->harga }}"  id="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal :</label>
                            <input type="date" value="{{ $orderbahanbaku->tanggal }}"  name="tanggal" class="form-control" id="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="petugas">Pic :</label>
                            <input type="text" name="petugas" class="form-control" value="{{ $orderbahanbaku->petugas }}"  id="petugas" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier">Penjual / supplier :</label>
                            <input type="text" name="supplier" class="form-control" value="{{ $orderbahanbaku->supplier }}"  id="supplier" >
                        </div>
                        <div class="form-group">
                            <label for="supplier">Keterangan :</label>
                            <textarea rows="4" name="keterangan" class="form-control" id="keterangan" >{{ $orderbahanbaku->keterangan }}</textarea>
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
