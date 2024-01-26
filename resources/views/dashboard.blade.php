@extends('layouts.layout')
@section('title', 'Dashboard')
@section('css')
    <style>
        .cardMenu {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, .14), 0px 1px 4px 0px rgba(0, 0, 0, .12);
        }

        .jumlah {
            font-weight: 700;
            color: black;
            font-size: 18px;
        }
    </style>

@endsection
@section('content')
    {{-- <div class="card p-4">
        <h5>Selamat Datang <b>{{ Auth::user()->name }} </b> di Dashboard </h5>
        <hr>
    </div> --}}
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card p-2 cardMenu">
                <div class="d-flex align-items-center">
                    <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                        <p><i class="fas fa-money-bill-alt " style="font-size:40px;color:#663300"></i></p>
                        <p>Pendapatan Hari Ini</p>
                    </span>
                    <span>
                        <p class="jumlah text-success">@currency($pendapatan_hari_ini)</p>
                        {{-- <a href="{{ route('pendapatan.index') }}" class="text-dark">Detail <i
                                class="fas fa-arrow-right"></i></a> --}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-2 cardMenu">
                <div class="d-flex align-items-center">
                    <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                        <p><i class=" fas fa-money-bill-alt " style="font-size:40px;color:#663300"></i></p>
                        <p>Pendapatan Bulan Ini</p>
                    </span>
                    <span>
                        <p class="jumlah text-success">@currency($pendapatan_bulan_ini)</p>
                        {{-- <a href="{{ route('pembelian.index') }}" class="text-dark">Detail <i
                                class="fas fa-arrow-right"></i></a> --}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-2 cardMenu">
                <div class="d-flex align-items-center">
                    <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                        <p><i class=" fas fa-money-bill-alt " style="font-size:40px;color:#663300"></i></p>
                        <p>Pendapatan Tahun Ini</p>
                    </span>
                    <span>
                        <p class="jumlah text-success">@currency($pendapatan_tahun_ini)</p>
                        {{-- <a href="" class="text-dark">Detail <i class="fas fa-arrow-right"></i></a> --}}
                    </span>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="card p-2 cardMenu">
                <div class="d-flex align-items-center">
                    <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                        <p><i class="fas fa-credit-card text-primary" style="font-size:40px"></i></p>
                        <p>Piutang</p>
                    </span>
                    <span>
                        <p class="jumlah text-success">@currency($piutang)</p>
                        <a href="" class="text-dark">Detail <i class="fas fa-arrow-right"></i></a>
                    </span>
                </div>
            </div>
        </div> --}}
        {{-- </div> --}}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 mt-3">

                <div class="flex">

                    <h4>Penjualan Tahunan</h4>
                    {{-- <form action="{{ route('penjualan.bulan') }}" method="GET"> --}}
                    <div class="form">
                        {{-- <label for="bulan">Pilih Bulan:</label>
                        <select name="bulan" id="bulan" class="mr-4">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select> --}}

                        <label for="tahun">Pilih Tahun:</label>
                        <select name="tahun" id="tahun-penjualan">
                            @for ($i = date('Y'); $i >= 2010; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- <button type="submit">Filter</button> --}}
                    </form>
                </div>
                <div id="chartTahun">
                    <canvas id="penjualan_tahunan"></canvas>
                </div>
                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="dataTable" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Menu </th>
                                    <th>Total Penjualan</th>
                                    <th>Tahun</th>
                                </tr>
                            </thead>
                            <tbody id="data-penjualan-tahunan">
                                @foreach ($penjualan_tahunan as $sales)
                                    <tr align="center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sales->menu->nama }}</td>
                                        <td>{{ $sales->total }}</td>
                                        <td>{{ $sales->year }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 mt-3">
                <div class="flex">

                    <h4>Penjualan Bulanan</h4>
                    <div class="form">
                        <label for="bulan">Pilih Bulan:</label>
                        <select name="bulan" id="bulan" class="mr-4">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>

                        <label for="tahun">Pilih Tahun:</label>
                        <select name="tahun" id="tahun">
                            @for ($i = date('Y'); $i >= 2010; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    </form>
                </div>
                <div id="chartBulan">
                    <canvas id="penjualan_bulanan"></canvas>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row">
        <div class="col-md-5">
            <div class="card p-4 mt-4">
                <div class="d-flex">
                    <h5 class="text-dark">Produk Terlaris </h5>
                    <div class="form-group ml-4">
                        <select type="text" name="bulan" id="bulan">
                            <option value="">--pilih bulan--</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        @php
                            $tahun_sekarang = date('Y');
                            $tahun_list = range($tahun_sekarang - 5, $tahun_sekarang);

                        @endphp
                        <select type="number" name="tahun" id="tahun" class="ml-3">
                            <option value="">--pilih tahun--</option>
                            @foreach ($tahun_list as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="font-weight-bold">
                            <td>No</td>
                            <td>Nama Produk</td>
                            <td>Jumlah Terjual</td>
                            <td>Bulan</td>
                            <td>Tahun</td>
                        </tr>
                        <tbody id="data-produk">
                            @foreach ($produk_terlaris as $pt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pt->nama_fg }}</td>
                                    <td>{{ $pt->jumlah_penjualan }}</td>
                                    <td>{{ $pt->bulan }}</td>
                                    <td>{{ $pt->tahun }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  --}}
    {{-- <div class="row align-items-center">
        <div class="col-md-4 ml-4">
            <img width="400px" height="400px" src="{{asset("asset/img/company.svg")}}" alt="">
        </div>
        <div class="col-md-6">
            <div class="card p-4">
            @foreach ($perusahaan as $perusahaan)
                <h4>{{$perusahaan->nama_usaha}}</h4>
                <p>{{$perusahaan->alamat}}</p>
                <p>{{$perusahaan->email}}</p>
                <p>{{$perusahaan->telepon}}</p>
            @endforeach

        </div>

        </div>
    </div> --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#dataTable2").DataTable();
            $('#bulan, #tahun').on('change', function() {
                var bulan = $('#bulan').val()
                var tahun = $('#tahun').val()
                $.ajax({
                    type: 'GET',
                    url: "{{ route('penjualan.bulan') }}",
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    },
                    success: function(data) {
                        var oldcanvasbulanan = document.getElementById('penjualan_bulanan');
                        if (oldcanvasbulanan) {
                            oldcanvasbulanan.remove()
                        }
                        // Buat elemen canvas baru
                        var newChartCanvas = document.createElement('canvas');
                        newChartCanvas.id = 'penjualan_bulanan';
                        if (data.length > 0) {
                            document.getElementById('chartBulan').appendChild(
                                newChartCanvas
                            );
                            // bulanan
                            chartBulanan(data, tahun)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText)
                    }
                })
            })
            $("#tahun-penjualan").on('change', function() {
                var tahun = $('#tahun-penjualan').val()
                $.ajax({
                    type: 'GET',
                    url: "{{ route('penjualan.tahun') }}",
                    data: {
                        tahun: tahun
                    },
                    success: function(data) {
                        var oldcanvastahunan = document.getElementById('penjualan_tahunan');
                        if (oldcanvastahunan) {
                            oldcanvastahunan.remove()
                        }
                        var newChartCanvas = document.createElement('canvas');
                        newChartCanvas.id = 'penjualan_tahunan';
                        if (data.length > 0) {
                            document.getElementById('chartTahun').appendChild(
                                newChartCanvas
                            ); // Gantilah 'chart-container' dengan ID atau
                            chartTahunan(data)
                        }
                        // } else {
                        //     var noDataMessage = document.createElement('p');
                        //     noDataMessage.textContent = 'Tidak ada data untuk tahun ' + tahun;
                        //     document.getElementById('chartTahun').appendChild(noDataMessage);
                        //     noDataMessage.remove()
                        // }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText)
                    }
                })
            })

            // Di dalam tag <script> pada chart.blade.php
            // Ambil data dari controller
            var penjualanTahunan = {!! json_encode($penjualan_tahunan) !!};
            var penjualanBulanan = {!! json_encode($penjualan_bulanan) !!};

            var namaMenuBulanan = []
            var jumlahBulanan = []

            //tahunan


            function chartTahunan(penjualanTahunan) {
                var penjualanMenuTahunan = {}
                penjualanTahunan.forEach(function(item, index) {
                    var namaMenu = item.menu.nama

                    if (!penjualanMenuTahunan[namaMenu]) {
                        penjualanMenuTahunan[namaMenu] = item.total
                    } else {
                        penjualanMenuTahunan[namaMenu] += item.total
                    }
                })

                var namaMenuTahunan = Object.keys(penjualanMenuTahunan)
                var jumlahTahunan = Object.values(penjualanMenuTahunan)


                // console.log("nama menu bulanan", jumlahBulanan)
                console.log("penjualan bulanan", penjualanBulanan)
                console.log("penjualan tahunan", penjualanTahunan)
                var ctx = document.getElementById('penjualan_tahunan').getContext('2d');

                var tahunChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: namaMenuTahunan,
                        datasets: [{
                            label: "Penjualan Tahun " + penjualanTahunan[0].year,
                            data: jumlahTahunan,
                            borderWidth: 1,
                            fill: false,
                            borderColor: '#663300',
                            color: '#663300',
                            backgroundColor: '#663300',
                        }]
                    },
                    options: {
                        animations: {
                            tension: {
                                duration: 1000,
                                easing: 'linear',
                                from: 1,
                                to: 0,
                                loop: true
                            }
                        },
                        scales: {
                            y: { // defining min and max so hiding the dataset does not change scale range
                                min: 0,
                                max: 100
                            }
                        }
                        // options: {
                        //     scales: {
                        //         y: {
                        //             beginAtZero: true
                        //         }
                        //     }
                        // }
                    }
                });
                console.log("chart", tahunChart)
            }

            chartTahunan(penjualanTahunan)

            // bulanan


            function chartBulanan(penjualanBulanan, tahun) {
                var penjualanMenuBulanan = {}
                penjualanBulanan.forEach(function(item, index) {
                    var namaMenu = item.menu.nama

                    if (!penjualanMenuBulanan[namaMenu]) {
                        penjualanMenuBulanan[namaMenu] = item.total
                    } else {
                        penjualanMenuBulanan[namaMenu] += item.total
                    }
                })

                var namaMenuBulanan = Object.keys(penjualanMenuBulanan)
                var jumlahBulanan = Object.values(penjualanMenuBulanan)

                var bulan = document.getElementById('penjualan_bulanan').getContext('2d');
                var bulanChart = new Chart(bulan, {
                    type: 'bar',
                    data: {
                        labels: namaMenuBulanan,
                        datasets: [{
                            label: "Penjualan periode " + penjualanBulanan[0].month_name + " " +
                                tahun,
                            data: jumlahBulanan,
                            borderWidth: 1,
                            borderColor: '#663300',
                            color: '#663300',
                            backgroundColor: '#663300',
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                console.log("chart", bulanChart)
                return bulanChart
            }

            var now = new Date();
            var currentYear = now.getFullYear();

            console.log(currentYear); // Menampilkan tahun saat ini di konsol

            chartBulanan(penjualanBulanan, currentYear)

        })
    </script>
@endsection
