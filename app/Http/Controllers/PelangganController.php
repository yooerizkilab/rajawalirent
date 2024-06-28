<?php

namespace App\Http\Controllers;

use App\Models\MutasiPoin;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('created_at', 'DESC')->when(request()->q, function ($pelanggan) {
            $pelanggan->where('nik', 'like', '%' . request()->q . '%')
                ->orWhere('nama', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('backend.pelanggan.index', compact('pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::with('mutasi')->find($id);
        $reward = Reward::orderBy('title', 'ASC')->where('status', 1)->get();
        return view('backend.pelanggan.show', compact('pelanggan', 'reward'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'reward' => 'required|exists:reward,id'
        ]);

        DB::beginTransaction();
        try {
            $pelanggan = Pelanggan::find($id);
            $reward = Reward::find($request->reward);
            if ($pelanggan->poin >= $reward->poin) {
                $pelanggan->update([
                    'poin' => ($pelanggan->poin - $reward->poin)
                ]);

                MutasiPoin::create([
                    'pelanggan_id' => $pelanggan->id,
                    'poin' => $reward->poin,
                    'type' => 0,
                    'keterangan' => 'Poin Reward ' . $reward->title
                ]);
                DB::commit();
                return redirect()->back()->with(['success' => 'Poin berhasil ditukar']);
            }
            return redirect()->back()->with(['error' => 'Poin tidak mencukupi']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
