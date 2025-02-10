@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Bahan Baku </h1>
        <!-- Button trigger modal -->


    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="card p-4">
        <div class="row">
            <div class="col-md-6 mt-2">
                <table class="table table-responsive ">
                    <tr>
                        <td><b>Nama Bahan Baku</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Harga</b></td>
                        <td>:</td>
                        <td>@currency($bahanbaku->harga) / {{$bahanbaku->satuan}}</td>
                    </tr>
                    <tr>
                        <td><b>Stok Sekarang</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->stok }}  {{$bahanbaku->satuan}}</td>
                    </tr>
                    <tr>
                        <td><b>Biaya Pesan</b></td>
                        <td>:</td>
                        <td>@currency($s) </td>
                    </tr>
                    <tr>
                        <td><b>Qty Pertahun</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->rata_rata_stok_pertahun }} {{$bahanbaku->satuan}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 mt-2">
                <table class="table table-responsive ">
                    <tr>
                        <td><b>Safety Stok (aman)</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->minimal_stok }}  {{$bahanbaku->satuan}}</td>
                    </tr>
                    <tr>
                        <td><b>Lead Time</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->lead_time }} hari</td>
                    </tr>
                    <tr>
                        <td><b>Reorder Point (ROP)</b></td>
                        <td>:</td>
                        <td>{{ $rop }} {{$bahanbaku->satuan}}</td>
                    </tr>
                    <tr>
                        <td><b>Economic Order Quantity (EOQ)</b></td>
                        <td>:</td>
                        <td>{{ $eoq}}  {{$bahanbaku->satuan}}</td>
                    </tr>

                    <tr>
                        <td><b>Status</b></td>
                        <td>:</td>
                        <td>{{ $bahanbaku->status == 1 && $bahanbaku->stok >= $bahanbaku->minimal_stok ? 'Aktif':'Tidak Aktif'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection

