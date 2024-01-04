@extends('layouts.layout')
@section('title', 'Jadwal Produksi')
@section('content')
    @include('sweetalert::alert')


    <div class="row">
        <div class="col-md-6">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class=" mb-0 text-gray-800">Input Bill Of Material Produksi </h4>
                <!-- Button trigger modal -->

            </div>
            <div class="card p-4">
                <form action="{{ route('billofmaterial.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fg">Finish Good :</label>
                            <select style="width:100%" name="finishgood_id" id="fg" class="form-control  " required>
                                <option selected disabled value="">-- Pilih Finish Good --</option>
                                @foreach ($fg as $fg)
                                    <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row align-items-center add-data">
                            <div class="col-md-6">
                                <label for="barang">Bahan Baku :</label>
                                <select style="width:100%" name="bahanbaku[]" id="barang" class="form-control  "
                                    required>
                                    <option selected disabled value="">-- Pilih Bahan Baku --</option>
                                    @foreach ($bahanbaku as $bb)
                                        <option value="{{ $bb->id }}">{{ $bb->nama_material }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                            </div>

                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(add).on('click', function() {
            $('.add-data').append(`<div class="form-group px-3 mt-2 row child align-items-center">
                            <div class="col-md-6">
                                <label for="barang">Bahan Baku:</label>
                                <select style="width:100%" name="bahanbaku[]" id="barang" class="form-control "
                                    required>
                                    <option selected disabled value="">-- Pilih Bahan Baku--</option>
                                    @foreach ($bahanbaku as $bb)
                                        <option value="{{ $bb->id }}">{{ $bb->nama_material }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button type="button" class="btn btn-sm  delete-child btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                         `)
        })
        $(document).on('click', '.delete-child', function() {
            $(this).parents('.child').remove()
        })
    </script>
@endsection
