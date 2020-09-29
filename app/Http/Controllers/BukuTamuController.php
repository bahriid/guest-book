<?php

namespace App\Http\Controllers;
use App\BukuTamu;
use DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BukuTamuController extends Controller
{
    public function index(){

        $tamus = BukuTamu::get();
        $years = [];
        $months = [];
        $days = [];
        foreach($tamus as $tamu){
            $buku_tamu = BukuTamu::where('id', $tamu['id'])->first();

            if (!in_array(Carbon::parse($buku_tamu['created_at'])->format('F'), $months)) {
                $months[] = Carbon::parse($buku_tamu['created_at'])->format('F');
            }
            if (!in_array(Carbon::parse($buku_tamu['created_at'])->format('Y'), $years)) {
                $years[] = Carbon::parse($buku_tamu['created_at'])->format('Y');
            }
            if (!in_array(Carbon::parse($buku_tamu['created_at'])->format('l'), $days)) {
                $days[] = Carbon::parse($buku_tamu['created_at'])->format('l');
            }

        }

        return view('index',[
            'days' => $days,
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function indexData(){

        $tamus = BukuTamu::get();

        $data[] = [
            'id' => null,
            'NIK' => null,
            'name' => null,
            'address' => null,
            'nomorhp' => null,
            'needs' => null,
            'action' => null,
            'day' => null,
            'month' => null,
            'year' => null,
            'date' => null,
        ];

        foreach($tamus as $tamu){
            $buku_tamu = BukuTamu::where('id', $tamu['id'])->first();

            $data[] = [
                'id' => $buku_tamu['id'],
                'NIK' => $buku_tamu['NIK'],
                'name' => $buku_tamu['name'],
                'address' => $buku_tamu['address'],
                'nomorhp' => $buku_tamu['nomorhp'],
                'needs' => $buku_tamu['needs'],
                'action' => '<a class="btn btn-xs blue-steel  btn-outline" href="/edit/'.$buku_tamu['id'].'" target="_blank"> <i class="fa fa-pen"></i> Edit</a><a class="btn btn-xs blue-steel  btn-outline" href="/delete/'.$buku_tamu['id'].'" target="_blank"><i class="fa fa-trash"></i> Hapus</a>',
                'day' => Carbon::parse($buku_tamu['created_at'])->format('l'),
                'month' => Carbon::parse($buku_tamu['created_at'])->format('F'),
                'year' => Carbon::parse($buku_tamu['created_at'])->format('Y'),
                'date' => Carbon::parse($buku_tamu['created_at'])->format('d, M Y H:i'),
            ];

        }

        return DataTables::of($data)->make(true);
    }

    public function create(){
        return view('create');
    }

    public function edit($id){
        $data = BukuTamu::where('id', $id)->first();
        return view('update',[
            'data' => $data,
        ]);
    }

    public function delete($id){
        $data = BukuTamu::where('id', $id)->first();
        $data->delete();
        return redirect()->route('index')->with('message', 'Penghapusan Tamu Berhasil');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'NIK' => 'required|numeric|unique:buku_tamus',
            'name' => 'required',
            'address' => 'required',
            'nomorhp' => 'required|numeric',
            'needs' => 'required',
        ]);

        $data = new BukuTamu();
        $data['NIK'] = $validatedData['NIK'];
        $data['name'] = $validatedData['name'];
        $data['address'] = $validatedData['address'];
        $data['needs'] = $validatedData['needs'];
        $data['nomorhp'] = $validatedData['nomorhp'];
        $data->save();

        return redirect()->route('index')->with('message', 'Penambahan Tamu Berhasil');
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'NIK' => 'required|numeric|unique:buku_tamus',
            'name' => 'required',
            'address' => 'required',
            'needs' => 'required',
        ]);

        $data = BukuTamu::where('id', $id)->first();
        $data['NIK'] = $validatedData['NIK'];
        $data['name'] = $validatedData['name'];
        $data['address'] = $validatedData['address'];
        $data['needs'] = $validatedData['needs'];
        $data['needs'] = $validatedData['needs'];
        $data->save();

        return redirect()->route('index')->with('message', 'Perubahan Tamu Berhasil');
    }
}
