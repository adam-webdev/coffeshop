@extends('layouts.layout')
@section('title', 'Detail Order')
@section('css')
    <style>

    </style>
@endsection

@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Order </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-md-5 mt-2">
            <div class="card p-4">
                {{-- <h5 class="pt-4 pl-2 text-center">Order</h5> --}}
                <div class="mt-2  d-flex justify-content-between align-items-center">
                    <p class="head">No Order : {{ $order[0]->no_order }}</p>
                    <p class="head">@customDateFormat($order[0]->waktu)</p>
                </div>
                <hr>
                <div id="order-summary">
                    {{-- <h2>Order Summary</h2> --}}
                    <ul style="margin-right: 25px">
                        <li width="100%" style="display:flex;justify-content:space-between;align-items:center;">
                            <span class="nama-menu">
                                Nama
                            </span>
                            <span>
                                Qty
                            </span>
                            <span>
                                Harga
                            </span>

                        </li>
                    </ul>
                    <hr>
                    <ul style="margin-right: 25px">
                        @foreach ($order[0]->orderdetail as $order)
                            <li width="100%" style="display:flex;justify-content:space-between;align-items:center;">
                                <span class="nama-menu">
                                    {{ $order->menu->nama }}
                                </span>
                                <span>
                                    {{ $order->jumlah }}

                                </span>
                                <span>
                                    x {{ $order->menu->harga }}

                                </span>

                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <span class="d-flex ">
                        <p>Meja : </p>
                        <p class="p-2 badge badge-primary">
                            {{ $order[0]->meja->nama ?? 'Dibungkus' }} </p>
                    </span>
                    <span class="d-flex ">
                        <p>Catatan : </p>

                        <p> {{ $order[0]->catatan ?? 'Tidak Ada' }}</p>
                    </span>
                    {{-- <span class="d-flex ">
                        <p>Kasir : </p>

                        <p> {{ $order[0]->pembayaran->user->name }}</p>
                    </span> --}}
                    {{-- <div class="custom-control custom-switch px-4">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Dibungkus ?</label>
                    </div>
                    <div id="dibungkus" class="px-4">
                        <select id="selectInput" name="meja_id" class="form-control select">
                            <option value="">-- Pilih Meja --</option>
                            @foreach ($meja as $meja)
                                <option value="{{ $meja->id }}" {{ $meja->status == 1 ? 'disabled' : '' }}>
                                    {{ $meja->nama }} <p>{{ $meja->status == 1 ? 'Terisi' : 'Kosong' }}</p>
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- <div class="px-4 mt-4">
                            <p>Dilayani Oleh : <span>{{ auth()->user()->name }}</span></p>
                            <p>Total Items: <span id="total-quantity">0</span></p>
                        </div> --}}
                </div>


            </div>

        </div>


    </div>

@endsection
@section('scripts')
    <script></script>
@endsection
