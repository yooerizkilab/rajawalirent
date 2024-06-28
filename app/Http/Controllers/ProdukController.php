<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\ProdukHarga;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')
            ->when(request()->q, function ($produk) {
                $produk->where('varian', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('merk', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('plat', 'LIKE', '%' . request()->q . '%');
            })->paginate(5);
        return view('backend.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('backend.produk.create');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('backend.produk.show', compact('produk'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'varian' => 'required|string|max:50',
            'merk' => 'required|string|max:20',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'plat' => 'required|string|unique:produk',
            'keterangan' => 'required|string',
            'feature' => 'required|array',
            'gambar' => 'required|image|mimes:png,jpg,jpeg',
            'bbm' => 'required|string',
            'transmisi' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'jarak_tempuh' => 'required|integer',
            'tempat_duduk' => 'required|integer',
            'bagasi' => 'required|integer',
            'unit' => 'required|integer',
        ]);

        $featuresString = implode(',', $request->feature);

        $filename = '';
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $request->plat . '-' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/produk', $filename);
        }

        Produk::create([
            'varian' => $request->varian,
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'warna' => $request->warna,
            'plat' => $request->plat,
            'keterangan' => $request->keterangan,
            'feature' => $featuresString,
            'gambar' => $filename,
            'bbm' => $request->bbm,
            'transmisi' => $request->transmisi,
            'tahun' => $request->tahun,
            'jarak_tempuh' => $request->jarak_tempuh,
            'tempat_duduk' => $request->tempat_duduk,
            'bagasi' => $request->bagasi,
            'unit' => $request->unit,
        ]);

        return redirect('admin/produk')->with(['success' => 'Produk berhasil ditambah']);
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $features = explode(',', $produk->feature);
        return view('backend.produk.edit', compact('produk', 'features'));
    }

    public function update(Request $request, $id)
    {
        $existing = Produk::where('plat', $request->plat)->first() ? true : false;
        $this->validate($request, [
            'varian' => 'required|string|max:50',
            'merk' => 'required|string|max:20',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'plat' => [
                Rule::requiredIf(!$existing),
                'required',
                'string'
            ],
            'keterangan' => 'required|string',
            'feature' => 'required|array',
            'gambar' => 'sometimes|nullable|image|mimes:png,jpg,jpeg',
            'bbm' => 'required|string',
            'transmisi' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'jarak_tempuh' => 'required|integer',
            'tempat_duduk' => 'required|integer',
            'bagasi' => 'required|integer',
            'unit' => 'required|integer',
        ]);

        $produk = Produk::find($id);
        $featuresString = implode(',', $request->feature);
        // Gunakan gambar yang sudah ada
        $filename = $produk->gambar;

        // Jika ada file gambar yang diunggah, proses file tersebut
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $request->plat . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/produk', $filename);

            // Hapus gambar lama jika ada
            Storage::disk('local')->delete('/public/produk/' . $produk->gambar);
        }

        $produk->update([
            'varian' => $request->varian,
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'warna' => $request->warna,
            'plat' => $request->plat,
            'keterangan' => $request->keterangan,
            'feature' => $featuresString,
            'gambar' => $filename,
            'bbm' => $request->bbm,
            'transmisi' => $request->transmisi,
            'tahun' => $request->tahun,
            'jarak_tempuh' => $request->jarak_tempuh,
            'tempat_duduk' => $request->tempat_duduk,
            'bagasi' => $request->bagasi,
            'unit' => $request->unit,
        ]);

        return redirect('admin/produk')->with(['success' => 'Produk berhasil diperbarui']);
    }


    public function destroy($id)
    {
        $produk = Produk::find($id);

        // Production
        Storage::disk('local')->delete('/public/produk/' . $produk->gambar);
        $produk->delete();
        return redirect('admin/produk')->with(['success' => 'Produk berhasil hapus']);
    }

    public function formHarga($id)
    {
        $produk = Produk::with('list_harga')->find($id);
        return view('backend.produk.harga', compact('produk'));
    }

    public function tambahHarga(Request $request, $id)
    {
        $this->validate($request, [
            'deskripsi' => 'required|string|max:100',
            'harga' => 'required|integer'
        ]);

        ProdukHarga::create([
            'produk_id' => $id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);

        return redirect()->back()->with(['success' => 'Data harga berhasil ditambah']);
    }

    public function hapusharga($id)
    {
        $harga = ProdukHarga::find($id);
        $harga->delete();

        return redirect()->back()->with(['success' => 'Data harga berhasil dihapus']);
    }
}
