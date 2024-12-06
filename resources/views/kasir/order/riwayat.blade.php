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
  .btn-status-paid {

    background: linear-gradient(to bottom, #eafdee, #ffffff); /* Gradasi merah muda ke putih */
    color: green; /* Teks merah pekat */
    border: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
  }

  .btn-status-unpaid {
     background: linear-gradient(to bottom, #ffe3e3, #ffffff); /* Gradasi merah ke putih */
    color: #cc0000; /* Teks merah pekat */
    border: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
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

  <div class="col-md-12 mt-2">
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
                @if ($o->meja_id !== null)
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
                  echo "<span class='btn btn-sm btn-status-paid '>Dibayar</span>";
                  } else {
                  echo "<span class='btn btn-sm btn-status-unpaid '>Belum</span>";
                  }
                  // {{ $o->status }}
                  @endphp
                </td>

                <td align="center" >
                @role('Admin')
                <div class="dropdown">
                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if ($o->status === 'unpaid')
                    <a class="dropdown-item" href="{{ route('pembayaran.order', [$o->id]) }}">Bayar</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('order.show', [$o->id]) }}">Detail</a>
                    @if ($o->status === 'paid')
                    <a class="dropdown-item" href="{{ route('cetak', [$o->id]) }}">Cetak Struk</a>
                    @endif
                    <a class="dropdown-item text-danger" href="/order/hapus/{{ $o->id }}" onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>
                    </div>
                </div>
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