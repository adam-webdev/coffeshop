<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/jpg" sizes="16x16" href="/favicon.jpg">

  <title>Warkop CoffeAreaKongkow</title>
  <link href="{{ asset('asset/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .navbar {
      width: 100%;
    }

    body {
      padding-top: 56px;
      overflow-x: hidden;
      /* Adjust the value based on your navbar height */
      align-items: center;
    }



    .img-menu {
      object-fit: cover;

    }

    .img-menu-habis {
      filter: grayscale(60);
      object-fit: cover;
    }

    .habis {
      position: absolute;
      top: 35%;
      left: 50%;
      background: white;
      font-weight: bold;
      padding: 4px 8px;
      border-radius: 20px;
      transform: translate(-50%, -50%);
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
      background-color: #663300;
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

    .terisi {
      background: rgb(189, 2, 2);
      padding: 2px;
      font-size: 11px;
      color: white;
    }

    .kosong {
      background: green;
      padding: 2px;
      font-size: 11px;
      color: white;
    }

    .cart-order {
      position: relative;
      cursor: pointer;

    }



    .cart-order .badge {
      position: absolute;
      margin-bottom: 10px;
      z-index: 999;
    }

    @media screen and (max-width: 767px) {


      .col-md-5,
      .col-md-7 {
        width: 98%;
        margin-right: 0;
        margin-left: 0;
      }

      #search-menu {
        width: 98%;
      }

      .menu {
        width: 98%;
        margin-bottom: 10px;
      }

      .img-menu {
        width: 100%;
        height: auto;
      }

      .head,
      .btn-decrease,
      .btn-increase,
      .btn-remove {
        font-size: 12px;
      }

      #order-summary ul li span {
        fon t-size: 12px;
      }

      body {
        font-size: 14px;
      }

      .custom-switch {
        margin-left: 0;
        margin-bottom: 10px;
        justify-content: center;
      }
    }

    @media screen and (max-width:450px) {

      /* .img-menu {
                width: 130px;
            } */
      .img-menu {
        width: 100%;
        height: auto;
      }

      .img-menu-habis {
        height: auto;
        width: 100%;

      }

      .head {
        font-size: 12px;
      }

      .btn-decrease,
      .btn-increase,
      .btn-remove {
        font-size: 12px;

      }

      #order-summary ul li span {
        font-size: 14px;

      }

      body {
        font-size: 14px;
      }
    }

    .data-order {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #ffd6ad;
      color: #663300;
      font-weight: bold;
      text-align: center;
      border-radius: 20px;
      padding: 8px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }

    .data-order.show {
      visibility: visible;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;

    }

    /* toast */
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #ffd6ad;
      color: #663300;
      font-weight: bold;
      text-align: center;
      border-radius: 20px;
      padding: 8px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }

    #snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @-webkit-keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }

    @keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }

    /* toast */
  </style>
</head>

<body>

  {{-- @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp --}}
  <nav class="navbar navbar-default fixed-top    bg-white shadow align-items-center justify-content-between" style="border-radius:8px;background-color:rgb(255, 255, 255)!important;">

    <ul>
      <!-- Sidebar Toggle (Topbar) -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bars"></i>

        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('login') }}">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Login Petugas
          </a>
          <div class="dropdown-divider"></div>
          {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a> --}}
        </div>
      </li>
    </ul>
    <h6 class="text-dark font-weight-bold">Coffeshop Area Kongkow </h6>
    <div class="cart-order" data-toggle="modal" data-target="#exampleModal">
      <span class="fas fa-shopping-bag" style="font-size:22px "></span>
      <span class="badge badge-primary" style="background: #663300" id="total-quantity">0</span>
    </div>
    <!-- Topbar Search -->
  </nav>


  <!-- Modal -->
  <div class="row">
    <div class="modal fade m-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <p>Menu pilihan anda</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card p-2">
            {{-- <h5 class="pt-4 pl-2 text-center">Order</h5> --}}
            <div class="mt-2 px-4 d-flex justify-content-between align-items-center">
              <p class="head"> {{ $no_order }}</p>
              <p class="head">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm') }}</p>
            </div>
            <hr>
            <form action="{{ route('order.user') }}" method="POST">
              @csrf
              <input type="hidden" name="no_order" value="{{ $no_order }}">
              <input type="hidden" name="total" id="total_order">
              <input type="hidden" name="waktu" value="{{ \Carbon\Carbon::now() }}">
              <div id="order-summary">
                {{-- <h2>Order Summary</h2> --}}
                <ul>
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

                <div class="custom-control custom-switch ]
                                '">
                  <input type="checkbox" class="custom-control-input" id="customSwitch1">
                  <label class="custom-control-label" for="customSwitch1">Dibungkus ?</label>
                </div>
                <div id="dibungkus" class="px-4">
                  <select id="selectInput" name="meja_id" class="form-control select">
                    <option value="">-- Pilih Meja --</option>
                    @foreach ($meja as $meja)
                    <option value="{{ $meja->id }}" {{ $meja->status == 1 ? 'disabled' : '' }}>
                      {{ $meja->nama }}
                      <p>
                        {{ $meja->status == 1 ? 'Terisi' : 'Kosong' }}
                      </p>
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 custom-control custom-switch px-4">
                  <input type="checkbox" class="custom-control-input" id="customSwitch2">
                  <label class="custom-control-label" for="customSwitch2">Ada catatan
                    ?</label>
                </div>
                <div id="catatan" class="px-4" style="display: none">
                  <textarea class="form-control catatan" type="text" name="catatan" rows="2" placeholder="Masukan catatan..."></textarea>
                </div>
                <div class="px-4 mt-4">
                  <p>Total Items: <span id="total-quantity">0</span></p>
                  {{-- <p>Total Price: <span id="total-price">@currency(0)</span></p> --}}
                </div>
              </div>

              <div class="form-group px-4">
                <button type="submit" class="d-block bayar btn btn-primary" style="background-color: #663300;">Order
                  @currency(0)</button>
              </div>
            </form>

          </div>


        </div>
      </div>
    </div>


    <div class="col-md-7 mt-2">
      <div class="card p-4">
        <div class="form-group">
          <label for="search">Search :</label>
          <input type="search" placeholder="cari menu..." id="search-menu">
        </div>
        <div class="d-flex tbody">
          @foreach ($menu as $m)
          <div class="menu">
            <a href="#" class="menu-link" @if ($m->status == 0)
              onclick="return false;" style="pointer-events: none; color: grey; text-decoration: none;"
              data-toggle="tooltip" title="Menu ini habis"
              @endif
              data-nama="{{ $m->nama }}"
              data-harga="{{ $m->harga }}"
              data-id="{{ $m->id }}"
              >

              <div class="card">
                @if ($m->status == 0)
                <img class="img-menu-habis" src="/storage/{{ $m->foto }}" width="150px" height="150px" alt="{{ $m->nama }}">
                @else
                <img class="img-menu" src="/storage/{{ $m->foto }}" width="150px" height="150px" alt="{{ $m->nama }}">
                @endif
                <div class="title p-2">
                  <span><b>{{ $m->nama }}</b></span><br>
                  <span>@currency($m->harga)</span>
                  @if ($m->status == 0)
                  <br><span class="habis" style="color: red;">Habis</span>
                  @endif
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>


  <p id="snackbar">item berhasil dipilih..</p>
  {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('asset/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('asset/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('asset/js/demo/chart-pie-demo.js') }}"></script>
  <script src="{{ asset('asset/js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('asset/vendor/select2/dist/js/select2.min.js') }}"></script>

  <script type="text/javascript">
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

      // search menu
      $("#search-menu").on("input", function() {
        var keyword = $(this).val().toLowerCase();
        console.log("keyword : ", keyword)

        $(".menu-link").each(function() {
          var menuName = $(this).data("nama")
          console.log("nama menu : ", menuName)

          if (menuName) {
            menuName = menuName.toLowerCase();
            console.log("nama menu lowercase : ", menuName)
          }
          var menuElement = $(this).parent();
          console.log("menu parent", menuElement)
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
        showToast($(this).data("nama"));
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

      // tombol tambah
      $(document).on("click", ".btn-increase", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        var selectedItem = orderList.find(item => item.id === id);
        if (selectedItem) {
          selectedItem.quantity += 1;
          updateOrderSummary()
        }
      })

      // tombol kurang
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

      //tombol hapus
      $(document).on("click", ".btn-remove", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        orderList = orderList.filter(item => item.id !== id);
        updateOrderSummary()
      })


      // format mata uang
      function formatCurrency(amount) {
        // Fungsi ini mengonversi nilai ke dalam format mata uang yang sesuai
        return new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR'
        }).format(amount);
      }

      // update order summary
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
                            <button class="btn mt-1 btn-decrease btn-sm " style="background:#DFD8D0;color:#663300;" data-id="${item.id}"><i class="fas fa-minus"></i></button>
                            <span class="mx-2">${item.quantity} </span>
                            <button class="btn mt-1 btn-increase btn-sm " style="background:#DFD8D0;color:#663300;" data-id="${item.id}"><i class="fas fa-plus"></i></button>
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
        $("#total_order").val(totalPrice);
        $(".bayar").text("  Order " + formatCurrency(totalPrice));

      }


    });

    function showToast(name) {
      var x = document.getElementById("snackbar");
      x.className = "show";
      x.textContent = `${name}  berhasil dipilih.`
      console.log(x)
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }

    // function shoMenu() {
    //     var x = document.getElementById("menu-order");
    //     x.className = "show";
    // }

    // function closeMenu() {
    //     var x = document.getElementById("menu-order");
    //     x.className = "";
    // }
  </script>


</body>

</html>