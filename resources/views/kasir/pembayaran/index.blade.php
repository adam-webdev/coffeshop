@extends('layouts.layout')
@section('title', 'Transaksi')

@section('css')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #fff;
            background-color: #8B4513;
            /* Warna coklat */
            border-color: #8B4513;
        }

        /* Gaya untuk warna pagination coklat pada hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff;
            background-color: #A0522D;
            /* Warna coklat tua pada hover */
            border-color: #A0522D;
        }

        /* Gaya untuk warna pagination coklat pada current page */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff;
            background-color: #A0522D;
            /* Warna coklat tua pada current page */
            border-color: #A0522D;
        }
    </style>
@endsection
@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Riwayat Transaksi </h1>
    </div>


    <!-- Modal -->
    <div class="row">

        <div class="col-md-10 mt-2">
            <div class="card p-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="table-responsive">
                        <table class="table  table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th width="2%">No</th>
                                    <th>No Order</th>
                                    <th>Total</th>
                                    <th>Uang </th>
                                    <th>Kembalian </th>
                                    <th>Waktu Pembayaran </th>
                                    <th>Metode Pembayaran </th>
                                    <th>Kasir </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $t)
                                    <tr align="center">
                                        <td width="2%">{{ $loop->iteration }}</td>
                                        <td>{{ $t->order->no_order }}</td>
                                        <td>@currency($t->total) </td>
                                        <td> <span class="badge badge-success">@currency($t->uang)</span> </td>
                                        <td><span class="badge badge-secondary">@currency($t->kembalian)</span> </td>
                                        <td>@customDateFormat($t->waktu_bayar)</td>
                                        <td>{{ $t->status }}</td>
                                        <td>{{ $t->user->name }}</td>

                                        <td align="center" width="10%">
                                            @role('Admin')
                                                {{-- <a href="{{ route('pembayaran.edit', [$t->id]) }}" data-toggle="tooltip"
                                                    title="Edit"
                                                    class="mt-2 d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                                    <i class="fas fa-edit fa-sm text-white"></i>
                                                </a> --}}
                                                <a href="/pembayaran/hapus/{{ $t->id }}" data-toggle="tooltip"
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
        <div class="col-md-2 mt-2">
            <div class="card p-2 cardMenu">
                <div class="d-flex align-items-center">
                    <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                        <p><i class="fas fa-money-check-alt " style="font-size:40px;color:#663300"></i></p>
                        <p>Total Transaksi</p>
                    </span>
                    <span>
                        <h2 class="jumlah text-success">{{ $pembayaran }}</h2>
                        {{-- <a href="{{ route('pendapatan.index') }}" class="text-dark">Detail <i
                                class="fas fa-arrow-right"></i></a> --}}
                    </span>
                </div>
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
            $('#example').DataTable();

        });
    </script>
@endsection
