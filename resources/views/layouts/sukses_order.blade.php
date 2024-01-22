<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order sukses</title>
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* .card {
            box-shadow:
        } */

        .card {

            border-radius: none !important;
            /* Radius sudut kartu */

            /* Box Shadow */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Koordinat x, y, blur, dan warna shadow */
            /* Penjelasan: Koordinat x=0, y=4px, blur=8px, warna dengan transparansi 0.1 */
        }

        /* Contoh hover effect */
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Efek shadow saat dihover */
            transform: scale(1.05);
            /* Efek scaling saat dihover */
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            /* Animasi transition */
        }

        .no-order {
            color: #663300;
            font-weight: bold;
            position: relative;

        }



        .no-order::before {
            content: '';
            /* Konten pseudoelement */
            position: absolute;
            /* Menetapkan posisi absolut */
            top: 50%;
            /* Posisi vertikal di tengah */
            left: 0;
            /* Posisi horizontal di ujung kiri */
            width: 100%;
            /* Lebar 100% */
            height: 2px;
            /* Tinggi garis coretan */
            /* background-color: #000; */
            /* Warna garis coretan */
            z-index: -1;
            /* Menetapkan posisi z-index di bawah elemen utama */

        }

        /* Style untuk mempercantik tampilan teks */
        .no-order {
            background-color: #ffd6ad;
            /* Warna latar belakang */
            padding: 0 10px;
            /* Padding agar teks tidak menyentuh tepi */
        }

        .btn {
            background: none;
            color: #663300;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="card p-4 mt-4 text-center">
            <h5 class="text-dark">Selamat order anda berhasil</h5>
            <p>Silahkan datang ke kasir dan tunjukan NO Order dibawah ini untuk melakukan pembayaran agar order makanan
                dan minuman disajikan.</p>
            <h2 class="no-order mb-4 mt-4">
                {{ $order->no_order }}
            </h2>
            <p>Kami menerima pembayaran Cash, Transfer, E-Wallet dan QRIS silahkan konfirmasi pada kasir.</p>

            <a href="/" class="mt-4 btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
