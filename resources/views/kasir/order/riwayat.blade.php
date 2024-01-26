@extends('layouts.layout')
@section('title', 'Riwayat Order')

@section('css')
    <style>
        .btn-bayar {
            background: green !important;
            color: white;

        }

        .btn-belum {
            color: white;
            background: red !important;
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
        <h1 class="h3 mb-0 text-gray-800">Data Order </h1>
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
                                    <th>Meja</th>
                                    <th>Catatan</th>
                                    <th>Total </th>
                                    <th>Waktu Order </th>
                                    <th>Status Pembayaran </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $o)
                                    <tr align="center">
                                        <td width="2%">{{ $loop->iteration }}</td>
                                        <td>{{ $o->no_order }}</td>
                                        @if ($o->meja_id)
                                            <td>{{ $o->meja->nama }}</td>
                                        @else
                                            <td>Dibungkus</td>
                                        @endif
                                        <td>{{ $o->catatan }}</td>
                                        <td>@currency($o->total) </td>
                                        <td>{{ \Carbon\Carbon::parse($o->waktu)->isoFormat('dddd, D MMMM Y, HH:mm') }}
                                        </td>
                                        <td>
                                            @php
                                                if ($o->status === 'paid') {
                                                    echo "<span class='btn btn-sm btn-bayar'>Dibayar</span>";
                                                } else {
                                                    echo "<span class='btn btn-sm btn-belum'>Belum</span>";
                                                }
                                                //  {{ $o->status }}
                                            @endphp
                                        </td>

                                        <td align="center" width="10%">
                                            @role('Admin')
                                                @if ($o->status === 'unpaid')
                                                    <a href="{{ route('pembayaran.order', [$o->id]) }}" data-toggle="tooltip"
                                                        title="Bayar" class="mt-2 d-sm-inline-block btn btn-sm btn-bayar ">
                                                        Bayar
                                                    </a>
                                                @endif
                                                <a href="{{ route('order.show', [$o->id]) }}" data-toggle="tooltip"
                                                    title="Detail Order"
                                                    class="mt-2 d-sm-inline-block btn btn-sm btn-secondary ">
                                                    Detail
                                                </a>
                                                <a href="/order/hapus/{{ $o->id }}" data-toggle="tooltip" title="Hapus"
                                                    onclick="return confirm('Yakin Ingin menghapus data?')"
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
