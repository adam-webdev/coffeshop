@extends('layouts.layout')
@section('title', 'Pembayaran')
@section('css')
    <style>
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

        .box-img {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tombol {
            margin-top: 30px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
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
        <h1 class="h3 mb-0 text-gray-800">Pembayaran Sukses</h1>
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
            <div class="card p-4">
                <div class="box-img">
                    <img width="100" src="/asset/img/ceklis.png" alt="Berhasil">
                </div>

                <div class="tombol">

                    <a href="#" class="btn btn-secondary"> <i class="fas fa-history"></i> Riwayat Transaksi</a>
                    <a href="#" class="btn" style="background: #663300;color:white;"><i class="fas fa-print"></i>
                        Cetak Struk</a>
                    <a href="#" class="btn btn-danger"> <i class="fas fa-times-circle"></i> Batalkan</a>
                </div>
            </div>

        </div>


    </div>

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

            // $("#uang").on("input", function() {
            //     var uang = $("#uang").val()
            //     var total = $("#total_order").val()

            //     var kembalian = uang - total;
            //     var total = $("#kembalian").val(kembalian)

            //     $(".bayar").prop("disabled", kembalian < 0)
            //     console.log(kembalian)
            // })







        });
    </script>
@endsection
