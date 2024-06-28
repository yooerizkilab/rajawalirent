<?php

namespace App\Http\Controllers;

use App\Models\MutasiPoin;
use PDF;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // View Tambah Transaksi
    public function formTransaksi()
    {
        $pelanggan = Pelanggan::orderBy('nama', 'DESC')->get();
        $produk = array_filter(Produk::orderBy('varian', 'ASC')->get()->map(function ($item) {
            if ($item->unit_available > 0) {
                return $item;
            }
        })->all());
        return view('backend.transaksi.form-transaksi', compact('pelanggan', 'produk'));
    }

    // Api Produk 
    public function getHargaProduk()
    {
        $harga = ProdukHarga::where('produk_id', request()->id)->get();
        return response()->json(['status' => 'success', 'data' => $harga]);
    }

    // Simpan Transaksi
    public function saveTransaksi(Request $request)
    {
        // Validation
        $this->validate($request, [
            'tipe_pelanggan' => 'required',
            'produk_id' => 'required|exists:produk,id',
            'layanan' => 'required|exists:produk_harga,id',
            'jaminan' => 'required',
            'foto_jaminan' => 'required|image|mimes:jpg,png,jpeg',
            'tgl_pinjam' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'lama_pinjam' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // New customer
            if ($request->tipe_pelanggan == 0) {

                // Handle KTP Photo File
                $ktpFile = $request->file('foto_ktp');
                $filename = $request->nik . '.' . $ktpFile->getClientOriginalExtension();
                $ktpFile->storeAs('public/pelanggan', $filename);

                $pelanggan = Pelanggan::create([
                    'nik' => $request->nik,
                    'foto_ktp' => $filename,
                    'nama' => $request->nama,
                    'notlp' => $request->notlp,
                    'alamat' => $request->alamat,
                ]);
            } else {
                // Existing customer
                $pelanggan = Pelanggan::find($request->pelanggan_id);
            }


            // Handle Jaminan Photo File
            $jaminanFile = $request->file('foto_jaminan');
            $jaminanFilename = $request->jaminan . '.' . $jaminanFile->getClientOriginalExtension();
            $jaminanFile->storeAs('public/jaminan', $jaminanFilename);

            $produkHarga = ProdukHarga::find($request->layanan);
            $tgl_pinjam = Carbon::parse($request->tgl_pinjam);

            $status =  $tgl_pinjam->format('Y-m-d') == Carbon::now()->format('Y-m-d') ? 1 : 0;

            Transaksi::create([
                // 'faktur' => $invoiceNumber,
                'pelanggan_id' => $pelanggan->id,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $jaminanFilename,
                'tgl_pinjam' => $tgl_pinjam->format('Y-m-d'),
                'tgl_kembali' => $tgl_pinjam->addDays($request->lama_pinjam)->format('Y-m-d'),
                'harga' => $produkHarga->harga,
                'denda' => 0,
                'tgl_dikembalikan' => null,
                'produk_id' => $request->produk_id,
                'user_id' => auth()->user()->id,
                'status' => $status
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Transaksi Berhasil dibuat !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan'])->orderBy('created_at', 'DESC')
            ->when(request()->q, function ($transaksi) {
                $transaksi->where('faktur', 'LIKE', '%' . request()->q . '%')
                    ->orWhere(function ($q) {
                        $q->whereHas('pelanggan', function ($query) {
                            $query->where('nama', 'LIKE', '%' . request()->q . '%');
                        });
                    });
            })
            ->paginate(10);
        return view('backend.transaksi.index', compact('transaksi'));
    }

    // View Detail Transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->find($id);
        return view('backend.transaksi.show', compact('transaksi'));
    }

    // Meminjamkan
    public function prosesTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update(['status' => 1]);
        return redirect()->back()->with(['success' => 'Kendaraan dipinjamkan!!']);
    }

    // belum selesai
    public function editTransaksi($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->find($id);
        return view('backend.transaksi.edit', compact('transaksi'));
    }

    // Mengembalikan 
    public function kembalikanTransaksi($id)
    {
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::find($id);

            $today = Carbon::now();
            $tgl_kembali = Carbon::parse($transaksi->tgl_kembali);
            $diff = $today->diffInDays($tgl_kembali, false);

            // Harga Denda
            // Harga denda setara harga sewa satu hari
            $denda = 0;
            if ($diff < 0) {
                $denda = $transaksi->harga * abs($diff);
            }

            $transaksi->update([
                'status' => 2,
                'denda' => $denda,
                'tgl_dikembalikan' => $today->format('Y-m-d')
            ]);

            $transaksi->pelanggan()->update(['poin' => $transaksi->pelanggan->poin + 1]);

            // Reward koin pelanggan
            MutasiPoin::create([
                'pelanggan_id' => $transaksi->pelanggan->id,
                'poin' => 1, // Teragantung sesuai kemauan
                'type' => 1,
                'keterangan' => 'Reward Poin Transaksi #' . $transaksi->faktur
            ]);


            DB::commit();
            return redirect()->back()->with(['success' => 'Kendaraan dikembalikan!!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // Membatalkan
    public function batalkanTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update(['status' => 3]);
        return redirect()->back()->with(['success' => 'Transaksi dibatalkan!!']);
    }

    // Invoice
    public function printTransaksi($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            // Handle case when transaction is not found
            return response()->json(['message' => 'Transaction not found.'], 404);
        }

        $pdf = PDF::loadView('pdf.invoice', compact('transaksi'));

        return $pdf->stream();
    }

    // Menghapus data Transaksi
    public function hapusTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->back()->with(['success' => 'Transaksi dihapus!!']);
    }
}
