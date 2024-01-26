@extends('layouts.layout')
@section('title', 'Hitung EOQ')

@section('css')

    <style>
        b {
            color: #663300;
            font-weight: 700;
        }
    </style>
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Economic Order Quantity</h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-md-3 mt-2">
            <div class="card p-4">
                <p><b> Rumus EOQ</b></p>
                <h3>EOQ = √(2SD/H)</h3>
                <hr>
                <p>S = Biaya Pemesanan untuk sekali pesan</p>
                <p>D = Permintaan, jumlah menu terjual dalam setahun / bulan</p>
                <p>H = Biaya Penyimpanan per unit bahan baku dalam setahun / sebulan</p>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="card">
                <h5 class="pt-4 pl-2 text-center"><b>Hitung EOQ</b></h5>
                <form action="{{ route('hitung.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Menu :</label>
                            <select name="bb_id" id="menu" class="form-control select">
                                <option value=""disabled>-- Pilih Bahan Baku -- </option>
                                @foreach ($bahanbaku as $bb)
                                    <option value="{{ $bb->id }}">{{ $bb->nama }} </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="order_cost">Biaya Pemesanan (S):</label>
                            <input class="form-control" type="number" name="order_cost" required>
                        </div>

                        <div class="form-group">
                            <label for="demand">Demand Total (D):</label>
                            <input class="form-control" type="number" name="demand" required>
                        </div>

                        <div class="form-group">
                            <label for="holding_cost">Biaya Penyimpanan (H):</label>
                            <input class="form-control" type="number" name="holding_cost" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary " style="background-color: #663300;" value="Hitung">
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-5 mt-2">

            <div class="card p-4">
                <h5><b>Hasil Perhitungan EOQ : </b></h5>
                <hr>
                <span class="d-flex">
                    <p>Biaya Pemesanan (S) :</p>
                    <p> {{ $orderCost ?? '0' }}</p>
                </span>
                <span class="d-flex">
                    <p>Demand (D) :</p>
                    <p> {{ $demand ?? '0' }}</p>
                </span>
                <span class="d-flex">
                    <p>Biaya Penyimpanan (D) :</p>
                    <p> {{ $holdingCost ?? '0' }}</p>
                </span>


                <span class="d-flex">
                    <p>√(2 * {{ $orderCost ?? 'S' }} * {{ $demand ?? 'D' }} / {{ $holdingCost ?? 'H' }}) :</p>
                    {{-- <p>{{ $holdingCost ?? '' }}</p> --}}
                </span>


                <hr>
                <span class="d-flex">
                    <p>Bahan Baku :</p>
                    <p><b> {{ $bahan_baku->nama ?? '-' }}</b></p>
                </span>
                <span class="d-flex">
                    <p>Hasil EOQ : </p>
                    <p><b> {{ $hasil_eoq ?? '0' }}</b> setiap melakukan pemesanan</p>
                </span>
                <span class="d-flex">
                    <p>Jumlah Pesanan yang disarankan : </p>
                    <p><b> {{ $jumlah_per_pesan ?? '0' }}</b> kali dalam setahun</p>
                </span>
                <span class="d-flex">
                    <p>Waktu dalam memesan: </p>
                    <p><b> {{ $waktu_memesan ?? '0' }} </b> hari sekali </p>
                </span>
            </div>
        </div>

        {{-- <div class="col-md-8 mt-2">
            <div class="card">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr align="center">
                                        <th width="2%">No</th>
                                        <th>Nama Meja</th>
                                        <th>Kursi</th>
                                        <th width="15%">Status </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meja as $m)
                                        <tr align="center">
                                            <td width="2%">{{ $loop->iteration }}</td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->kursi }}</td>
                                            <td width="15%">
                                                @php
                                                    if ($m->status == 0) {
                                                        echo '<i style="color: green" class="fas fa-circle"></i> Kosong';
                                                    } else {
                                                        echo '<i style="color: red" class="fas fa-circle"></i> Terisi';
                                                    }
                                                @endphp
                                            </td>
                                            <td align="center" width="10%">
                                                @role('Admin')
                                                    <a href="{{ route('meja.edit', [$m->id]) }}" data-toggle="tooltip"
                                                        title="Edit"
                                                        class="mt-2  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                        <i class="fas fa-edit fa-sm text-white"></i>
                                                    </a>
                                                    <a href="/meja/hapus/{{ $m->id }}" data-toggle="tooltip"
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
        </div> --}}
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: '100%'
            });
            // $('#example').DataTable();

        });
    </script>
@endsection
