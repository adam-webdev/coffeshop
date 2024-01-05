@extends('layouts.layout')
@section('title', 'Order')
@section('css')
    <style>
        .img-menu {
            object-fit: cover;

        }

        a.menu-link {
            color: #663300;
            text-decoration: none;
            text-align: center;
        }

        .tbody {
            display: flex;
            gap: 5px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .bayar {
            width: 100%;
            height: 40px;
            font-weight: 800;
        }

        button.bayar:hover {
            background-color: #663300b0;
        }

        .nama-menu {
            width: 120px;
        }

        #search-menu {
            padding: 4px 8px;
            border-radius: 20px;
            outline: none;
            border: 1px solid #663300;
        }

        .custom-switch {
            margin-left: 40px;
            cursor: pointer;
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #663300;
            /* Warna latar belakang */
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
        <h1 class="h3 mb-0 text-gray-800">Order </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole --}}

    </div>


    <!-- Modal -->
    <div class="row">
        <div class="col-md-5">
            <div class="card ">
                {{-- <h5 class="pt-4 pl-2 text-center">Order</h5> --}}
                <div class="mt-2 px-4 d-flex justify-content-between align-items-center">
                    <p>No Order : {{ $no_order }}</p>
                    <p>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm') }}</p>
                </div>
                <hr>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf

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
                                <span>
                                    Aksi
                                    </sp>
                            </li>
                        </ul>
                        <hr>
                        <ul id="order-list"></ul>
                        <hr>

                        <div class="custom-control custom-switch px-4">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Dibungkus ?</label>
                        </div>
                        <div id="dibungkus" class="px-4">
                            <select id="selectInput" name="meja_id" class="form-control select">
                                <option value="">-- Pilih Meja --</option>
                                @foreach ($meja as $meja)
                                    <option value="{{ $meja->id }}">{{ $meja->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 custom-control custom-switch px-4">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2">Ada catatan ?</label>
                        </div>
                        <div id="catatan" class="px-4" style="display: none">
                            <textarea class="form-control catatan" type="text" name="catatan" rows="2" placeholder="Masukan catatan..."></textarea>
                        </div>
                        <div class="px-4 mt-4">
                            <p>Dilayani Oleh : <span>{{ auth()->user()->name }}</span></p>
                            <p>Total Items: <span id="total-quantity">0</span></p>
                            {{-- <p>Total Price: <span id="total-price">@currency(0)</span></p> --}}
                        </div>
                    </div>

                    {{-- <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Menu :</label>
                            <input type="text" name="nama" class="form-control id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Jumlah :</label>
                            <input type="number" name="harga" class="form-control" id="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga :</label>
                            <input type="number" name="harga" class="form-control" id="harga" required>
                        </div>

                    </div> --}}
                    {{-- <button type="button" class="btn  btn-secondary" onclick="history.go(-1)"> Batal</button> --}}
                    <div class="form-group px-4">
                        <button type="submit" class="d-block bayar btn btn-primary"
                            style="background-color: #663300;">Bayar @currency(0)</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-7">
            <div class="card p-4">
                <div class="form-group">
                    <label for="search">Search :</label>
                    <input type="search" placeholder="cari menu..." id="search-menu">
                </div>
                <div class="d-flex tbody">
                    @foreach ($menu as $m)
                        <div class="menu">
                            <a href="#" class="menu-link" data-nama="{{ $m->nama }}"
                                data-harga="{{ $m->harga }}" data-id="{{ $m->id }}">
                                <div class="card">
                                    <img class="img-menu" src="/storage/{{ $m->foto }}" width="150px" height="150px"
                                        alt="{{ $m->nama }}">
                                    <div class="title p-2">
                                        <span><b>{{ $m->nama }}</b></span><br>
                                        <span>@currency($m->harga)</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customSwitch1').change(function() {
                // Jika toggle switch off, tampilkan select input
                if (!$(this).prop('checked')) {
                    $('#dibungkus').show();
                } else {
                    // Jika toggle switch on, sembunyikan select input
                    $('#dibungkus').hide();
                }
            });
            $('#customSwitch2').change(function() {
                // Jika toggle switch off, tampilkan select input
                if (!$(this).prop('checked')) {
                    $('#catatan').hide();
                } else {
                    // Jika toggle switch on, sembunyikan select input
                    $('#catatan').show();
                }
            });
            $('.select').select2({
                tags: true,
                width: '100%'
            });
            var dataList = @json($menu); // Inisialisasi orderList dari PHP

            console.log("data : ", dataList)
            // ... (bagian skrip lainnya tetap sama)

            $("#search-menu").on("input", function() {
                var keyword = $(this).val().toLowerCase();

                $(".menu-link").each(function() {
                    var menuName = $(this).data("nama").toLowerCase();
                    var menuElement = $(this).parent();
                    console.log(menuElement)
                    // Menyembunyikan atau menampilkan menu berdasarkan pencarian
                    if (menuName.includes(keyword)) {
                        menuElement.show();
                    } else {
                        menuElement.hide();
                    }
                });
            });
            var orderList = [];

            $(".menu-link").on("click", function(e) {
                e.preventDefault();

                var nama = $(this).data("nama");
                var id = $(this).data("id");
                var harga = $(this).data("harga");
                var quantity = 1;

                var existingItem = orderList.find(item => item.id === id)
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    orderList.push({
                        id,
                        nama,
                        harga,
                        quantity
                    })
                }
                updateOrderSummary();

            })

            $(document).on("click", ".btn-increase", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var selectedItem = orderList.find(item => item.id === id);
                if (selectedItem) {
                    selectedItem.quantity += 1;
                    updateOrderSummary()
                }
            })
            $(document).on("click", ".btn-decrease", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var selectedItem = orderList.find(item => item.id === id);
                if (selectedItem && selectedItem.quantity > 1) {
                    selectedItem.quantity -= 1;
                    updateOrderSummary()
                } else {
                    orderList = orderList.filter(item => item.id !== id);
                    updateOrderSummary()
                }
            })
            $(document).on("click", ".btn-remove", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                orderList = orderList.filter(item => item.id !== id);
                updateOrderSummary()
            })

            function formatCurrency(amount) {
                // Fungsi ini mengonversi nilai ke dalam format mata uang yang sesuai
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(amount);
            }

            function updateOrderSummary() {
                var totalQuantity = 0;
                var totalPrice = 0;

                $("#order-list").empty();
                orderList.forEach(function(item) {
                    totalQuantity += item.quantity;
                    totalPrice += item.harga * item.quantity;
                    var truncatedNama = item.nama.length > 7 ? item.nama.substring(0, 7) + '...' : item
                        .nama;

                    $("#order-list").append(`
                    <li width="100%" class="mt-1" style="display:flex;justify-content:space-between;align-items:center;">

                        <span class="nama-menu" title="${item.nama}" style="color:#663300;">
                            ${truncatedNama}
                        </span>
                        <span>
                            <button class="btn btn-decrease btn-sm " style="background:#DFD8D0;color:#663300;" data-id="${item.id}"><i class="fas fa-minus"></i></button>
                            <span class="mx-2">${item.quantity} </span>
                            <button class="btn btn-increase btn-sm " style="background:#DFD8D0;color:#663300;" data-id="${item.id}"><i class="fas fa-plus"></i></button>
                        </span>
                        <span>
                            x ${formatCurrency(item.harga)}
                        </span>


                        <button class="btn btn-remove mr-2" style="background:#DFD8D0;color:#663300" data-id="${item.id}"><i class="fas fa-trash-alt fa-sm "></i></button>
                        <input name="menu_id[]" value="${item.id}" type="hidden">
                        <input name="jumlah[]" value="${item.quantity}" type="hidden">
                    </li>

                    `)
                });
                $("#total-quantity").text(totalQuantity);
                $("#total-price").text(formatCurrency(totalPrice));
                $(".bayar").text("  Bayar " + formatCurrency(totalPrice));

            }


        });
    </script>
@endsection
