<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BillOfMaterial;
use App\Models\FinishGood;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BillOfMaterialController extends Controller
{
    public function index()
    {
        $bom = BillOfMaterial::with('bahanbaku', 'finishgood')->get();
        return view('produksi.bill_of_material.index', compact('bom'));
    }

    public function create()
    {
        $fg = FinishGood::all();
        $bahanbaku = BahanBaku::all();
        return view('produksi.bill_of_material.create', compact('fg', 'bahanbaku'));
    }

    public function store(Request $request)
    {
        $bahanbaku = $request->input('bahanbaku', []);
        $jumlah = $request->input('jumlah', []);

        $new_data = [];

        foreach ($bahanbaku as $index => $value) {
            $new_data[] = [
                "finishgood_id" => $request->finishgood_id,
                "bahanbaku_id" => $bahanbaku[$index],
                "jumlah" => $jumlah[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }

        BillOfMaterial::insert($new_data);
        Alert::success("Tersimpan", "Data berhasil disimpan");
        return redirect()->route('billofmaterial.index');
    }

    public function edit($id)
    {
        $data = BillOfMaterial::findOrFail($id);
        $fg = FinishGood::all();
        $bahanbaku = BahanBaku::all();
        return view("produksi.bill_of_material.edit", compact('data', 'bahanbaku', 'fg'));
    }


    public function update(Request $request, $id)
    {
        $data = BillOfMaterial::findOrFail($id);
        $data->bahanbaku_id =  $request->bahanbaku_id;
        $data->finishgood_id = $request->finishgood_id;
        $data->jumlah = $request->jumlah;
        $data->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('billofmaterial.index');
    }


    public function delete($id)
    {
        $bom = BillOfMaterial::findOrFail($id);
        $bom->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('billofmaterial.index');
    }
}