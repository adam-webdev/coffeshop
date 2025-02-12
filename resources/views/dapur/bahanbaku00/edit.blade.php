@extends('layouts.layout')
@section('title', 'Edit Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <h5 class="pt-4 pl-2">Edit Bahan Baku</h5>

                <form action="{{ route('bahan-baku.update', [$bahanbaku->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input type="text" name="nama" value="{{ $bahanbaku->nama }}" class="form-control"
                                id="nama" required>
                        </div>

                        <div class="form-group ">
                            <label for="harga">Harga :</label>
                            <input type="number" name="harga" value="{{ $bahanbaku->harga }}" class="form-control"
                                id="harga" required>
                        </div>
                        <div class="form-group ">
                            <label for="minimal">Minimal Stok :</label>
                            <input type="number" name="minimal_stok" value="{{ $bahanbaku->minimal_stok }}"
                            class="form-control" id="minimal" required>
                        </div>
                        <div class="form-group ">
                            <label for="stok">Stok :</label>
                            <input type="number" name="stok" value="{{ $bahanbaku->stok }}" class="form-control"
                                id="jumlah" required>
                        </div>

                         <div class="form-group ">
                            <label for="lead_time">Lead Time:</label>
                            <input type="text" name="lead_time" value="{{ $bahanbaku->lead_time }}" class="form-control" id="lead_time" >
                        </div>
                        <div class="form-group ">
                            <label for="rata_rata_stok_pertahun">Rata Rata Stok Pertahun :</label>
                            <input type="text" name="rata_rata_stok_pertahun" value="{{ $bahanbaku->rata_rata_stok_pertahun }}"  class="form-control" id="rata_rata_stok_pertahun" >
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang :</label>
                            <select style="width:100%" name="satuan" id="satuan" class="form-control select" required>
                                <option selected disabled value="">-- Pilih Satuan Barang --</option>
                                <option value="Gram" {{ $bahanbaku->satuan == 'Gram' ? 'selected' : '' }}>Gram</option>
                                <option value="Kg" {{ $bahanbaku->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                                <option value="Liter" {{ $bahanbaku->satuan == 'Liter' ? 'selected' : '' }}>Liter</option>
                                <option value="Pcs" {{ $bahanbaku->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="Box" {{ $bahanbaku->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                                <option value="Sachet" {{ $bahanbaku->satuan == 'Sachet' ? 'selected' : '' }}>Sachet
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nohp">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""disabled>-- Pilih Status -- </option>
                                <option value="1" {{ $bahanbaku->status == 1 ? 'selected' : '' }}>Aktif </option>
                                <option value="0" {{ $bahanbaku->status == 0 ? 'selected' : '' }}>Tidak Aktif </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="Button" class="btn btn-secondary btn-send" value="Kembali" onclick="history.go(-1)">
                        <input type="submit" class="btn btn-success btn-send" style="background-color: #663300"
                            value="Update">
                    </div>
                    </fieldset>
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
