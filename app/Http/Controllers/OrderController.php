<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('id', 'desc')->get();
        $meja = Meja::get();
        $no_order = Order::no_order();
        return view('kasir.order.index', compact('menu', 'no_order', 'meja'));
    }
}
