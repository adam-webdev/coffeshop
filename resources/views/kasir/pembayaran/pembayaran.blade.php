@extends('layouts.layout')
@section('title', 'Pembayaran')
@section('css')
    <style>
        .body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        #receipt {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }

        h2 {
            text-align: center;
            font-size: 1.2em;
        }

        span {
            text-align: center;
            font-size: 14px;
        }

        p.span {
            text-align: center;
            font-size: 12px;
            margin: -4px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        #total {
            font-weight: bold;
            margin-top: 10px;
        }

        #printButton {
            margin-top: 10px;
            display: block;
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .total {
            background: rgb(1, 147, 1);
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .total p {
            font-size: 20px;
            font-weight: bold;
            color: white;
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
        <h1 class="h3 mb-0 text-gray-800">Pembayaran </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-lg-5 col-md-10 col-sm-12">
            <div class="card ">
                {{-- <h5 class="pt-4 pl-2 text-center">Order</h5> --}}

                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf

                    <div class="total">
                        <p>Total @currency($order->total)</p>
                    </div>
                    <div class="mt-2 px-4 d-flex justify-content-between align-items-center">
                        <p>No Order : {{ $order->no_order }}</p>
                        <p>Waktu Pesan : {{ \Carbon\Carbon::parse($order->waktu)->isoFormat('dddd, D MMMM Y, HH:mm') }}</p>
                    </div>
                    <div class="form-group my-2 px-4">
                        <input type="number" name="uang" id="uang" placeholder="Masukan uang..." required
                            class="form-control py-4">
                    </div>
                    <div class="form-group my-2 px-4">
                        <input type="number" readonly id="kembalian" name="kembalian" placeholder="Kembalian..."
                            class="form-control py-4">
                    </div>
                    <div class="form-group my-2 px-4">
                        <button type="submit" class="d-block w-100 mt-3  bayar btn btn-primary"
                            style="background-color: #663300;" disabled>Proses</button>
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="total" id="total_order" value="{{ $order->total }}">
                    <input type="hidden" name="user_id" id="total_order" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="waktu_bayar" value="{{ \Carbon\Carbon::now() }}">

                </form>
            </div>

        </div>


    </div>
    {{-- <div class="body">
        <div id="receipt">
            <h2>Coffe AreaKongkow</h2>
            <p class="span">Jln Sama Aku mau ga</p>
            <p class="span">Sabtu, 12 Januari 2024 19:43:03</p>
            <div class="item" style="margin-top: 10px">
                <span>Item</span>
                <span>Qty</span>
                <span>Harga</span>
            </div>
            <hr style="border-top: 1px dashed #5b5b5b;">

            <div class="item">
                <span>Kentang goreng </span>
                <span>1</span>
                <span>$10.00</span>
            </div>

            <div class="item">
                <span>Barang 2</span>
                <span>2</span>
                <span>$15.00</span>
            </div>

            <div class="item">
                <span>Total:</span>
                <span>$25.00</span>
            </div>

            <hr style="border-top: 1px dashed #5b5b5b;">

            <div class="item" style="font-weight: bold;">
                <span>Tunai:</span>
                <span>$30.00</span>
            </div>

            <div class="item" style="font-weight: bold;">
                <span>Kembalian:</span>
                <span>$5.00</span>
            </div>

            <hr style="border-top: 1px dashed #5b5b5b;">

            <div class="item">
                <span>Terima kasih!</span>
            </div>

            <button id="printButton" onclick="printReceipt()">Print Struk</button>
        </div>
    </div> --}}
@endsection
@section('scripts')
    <script>
        function printReceipt() {
            window.print();
        }
        $(document).ready(function() {

            $('.select').select2({
                tags: true,
                width: '100%'
            });


            // console.log("data : ", dataList)
            // ... (bagian skrip lainnya tetap sama)

            $("#uang").on("input", function() {
                var uang = $("#uang").val()
                var total = $("#total_order").val()

                var kembalian = uang - total;
                var total = $("#kembalian").val(kembalian)

                $(".bayar").prop("disabled", kembalian < 0)
                console.log(kembalian)
            })


            // $("#search-menu").on("input", function() {
            //     var keyword = $(this).val().toLowerCase();

            //     $(".menu-link").each(function() {
            //         var menuName = $(this).data("nama").toLowerCase();
            //         var menuElement = $(this).parent();
            //         console.log(menuElement)
            //         // Menyembunyikan atau menampilkan menu berdasarkan pencarian
            //         if (menuName.includes(keyword)) {
            //             menuElement.show();
            //         } else {
            //             menuElement.hide();
            //         }
            //     });
            // });
            // var orderList = [];






        });
    </script>
@endsection
