<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }



    public static function no_order()
    {
        $tahunSekarang = Carbon::now()->format("Y");
        $bulanSekarang = Carbon::now()->format("m");
        $jumlahOrder = Order::max('id');
        $jumlahOrderIncrement = $jumlahOrder + 1;
        $no_order = (string) 'Order/' . $tahunSekarang . $bulanSekarang . "/" . $jumlahOrderIncrement;
        return $no_order;
    }
}
