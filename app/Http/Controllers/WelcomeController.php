<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use PDF;

class WelcomeController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        // Calculate the years experienced since 2023

        $counter = [
            'years_experienced' => $data1 = $currentYear - 2023,
            'total_cars' => $data2 = Produk::count(),
            'happy_customers' => $data3 = Pelanggan::count(),
            'total_transaction' => $data4 = Transaksi::count()
        ];

        $produk = Produk::with(['list_harga' => function ($query) {
            $query->where('deskripsi', 'Per Hari');
        }])->orderBy('created_at', 'ASC')->take(5)->get();

        $recent = Blog::orderByDesc('views')
            ->take(5)
            ->get();
        // return $recent;

        return view('welcome', compact('produk', 'counter', 'recent'));
    }

    public function about()
    {
        $currentYear = Carbon::now()->year;
        // Calculate the years experienced since 2023

        $counter = [
            'years_experienced' => $data1 = $currentYear - 2023,
            'total_cars' => $data2 = Produk::count(),
            'happy_customers' => $data3 = Pelanggan::count(),
            'total_transaction' => $data4 = Transaksi::count()
        ];
        return view('about', compact('counter'));
    }

    public function cars(Request $request)
    {
        $produk = Produk::with(['list_harga' => function ($query) {
            $query->where('deskripsi', 'Per Hari');
        }])
            ->when($request->category, function ($query, $category) {
                $query->where('tipe', $category);
            })
            ->when(request()->q, function ($search) {
                $search->where('varian', 'like', '%' . request()->q . '%')
                    ->orWhere('merk', 'like', '%' . request()->q . '%');
            })
            ->orderBy('created_at', 'ASC')
            ->paginate(12);

        return view('cars', compact('produk'));
    }

    public function viewCars($id)
    {
        $produk = Produk::where('varian', $id)->first();
        $related = Produk::with(['list_harga' => function ($query) {
            $query->where('deskripsi', 'Per Hari');
        }])->orderBy('created_at', 'desc')->take(3)->get();

        $allFeatures = [
            'AC', 'Airbag', 'Sunroof',
            'GPS', 'Child-Seat', 'Luggage',
            'Music', 'Seat-Belt', 'Sleeping-Bed',
            'Water', 'Bluetooth', 'Onboard-Computer',
            'Audio-Input', 'Long-Term-Trips', 'Car-Kit',
            'Remote-Central-locking', 'Climate-control'
        ];
        $featuresFromDatabase = explode(',', $produk->feature);

        return view('cars-detail', compact('produk', 'related', 'allFeatures', 'featuresFromDatabase'));
    }

    public function orderCars($id)
    {
        $produk = Produk::with(['list_harga' => function ($query) {
            $query->where('deskripsi', 'Per Hari');
        }])->where('varian', $id)->firstOrFail();
        $pelanggan = Pelanggan::where('nik', request()->nik)->first();
        $produkHarga = ProdukHarga::where('produk_id', $produk->id)->get();

        return view('order-cars', compact('produk', 'produkHarga', 'pelanggan'));
    }

    public function saveOrder(Request $request)
    {
        // Validation
        $existing = Pelanggan::where('nik', $request->nik)->first() ? true : false;
        $this->validate($request, [
            'nik' => [
                Rule::requiredIf(!$existing),
                'required',
                'string'
            ],
            'foto_ktp' => [
                Rule::requiredIf(!$existing),
                'image',
                'mimes:jpg,jpeg,png'
            ],
            'nama' => [
                Rule::requiredIf(!$existing),
                'string', 'max:150'
            ],
            'notlp' => [
                Rule::requiredIf(!$existing),
                'string', 'max:15'
            ],
            'alamat' => [
                Rule::requiredIf(!$existing),
                'string'
            ],
            'layanan' => 'required|exists:produk_harga,id',
            'jaminan' => 'required',
            'foto_jaminan' => 'required|image|mimes:jpg,png,jpeg',
            'tgl_pinjam' => 'required|date|after:' . Carbon::now()->format('Y-m-d'),
            'lama_pinjam' => 'required'
        ]);

        DB::beginTransaction();
        try {

            // Handle KTP Photo File
            $filename = '';
            if ($request->hasFile('foto_ktp')) {
                $ktpFile = $request->file('foto_ktp');
                $filename = $request->nik . '.' . $ktpFile->getClientOriginalExtension();
                $ktpFile->storeAs('public/pelanggan', $filename);
            }

            $pelanggan = Pelanggan::firstOrCreate(
                ['nik' => $request->nik],
                [
                    'foto_ktp' => $filename,
                    'nama' => $request->nama,
                    'notlp' => $request->notlp,
                    'alamat' => $request->alamat,
                ]
            );

            $produkHarga = ProdukHarga::with('produk')->findOrFail($request->layanan);
            $tgl_pinjam = Carbon::parse($request->tgl_pinjam);
            $user = User::first();

            // Handle File Foto Jaminan
            $jaminanFile = $request->file('foto_jaminan');
            $jaminanFilename = $request->jaminan . '.' . $jaminanFile->getClientOriginalExtension();
            $jaminanFile->storeAs('public/transaksi', $jaminanFilename);

            $transaksi = Transaksi::create([
                'pelanggan_id' => $pelanggan->id,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $jaminanFilename,
                'tgl_pinjam' => $tgl_pinjam->format('Y-m-d'),
                'tgl_kembali' => $tgl_pinjam->addDays($request->lama_pinjam)->format('Y-m-d'),
                'harga' => $produkHarga->harga,
                'denda' => 0,
                'tgl_dikembalikan' => null,
                'produk_id' => $produkHarga->produk->id,
                'user_id' => $user->id,
                'status' => 0
            ]);

            DB::commit();
            $url = url('cars/orders-detail/' . $transaksi->id);
            return redirect($url);
            // return redirect()->route('orders-detail', ['id' => $transaksi->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Melakukan Pemesanan: ' . $e->getMessage()]);
        }
    }

    public function detailOrders($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->findOrFail($id);
        $produkHarga = ProdukHarga::where('produk_id', $transaksi->produk->id)->first();

        // return $produkHarga;
        return view('order-detail', compact('transaksi', 'produkHarga'));
    }

    public function pay(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'transaksi_id' => 'required|exists:transaksi,id',
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = uniqid();
        $grossAmount = $request->harga;

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ];

        $customerDetails = [
            'nama' => $request->nama,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);

            $transaksi = Transaksi::where('id', $request->transaksi_id)->first();
            $transaksi->snap_token = $snapToken;
            $transaksi->save();

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentNotification(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'pay' => 'required|string'
        ]);

        try {
            $transaksi = Transaksi::where('id', $request->transaksi_id)->first();
            $transaksi->pay = $request->pay;
            $transaksi->save();

            return response()->json(['message' => 'Transaction status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function invoice(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->transaksi_id);

        // Generate PDF using a library like dompdf
        $pdf = PDF::loadView('pdf.invoicePelanggan', compact('transaksi'));

        return $pdf->download('invoice.pdf');
    }

    public function paket()
    {
        return view('paket');
    }

    public function blog()
    {
        // Paginate blogs with 5 items per page
        // Ambil blog yang sudah diterbitkan sebelum atau pada tanggal sekarang
        $blog = Blog::whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        return view('blog', compact('blog'));
    }

    public function viewBlog($id)
    {
        // Menemukan blog berdasarkan slug
        $blog = Blog::where('slug', $id)->firstOrFail();
        $tags = explode(',', $blog->tag);

        // recent
        $recent =  Blog::orderByDesc('views')
            ->take(5)
            ->get();

        // Tingkatkan view count
        DB::table('blog')->where('id', $blog->id)->increment('views');

        return view('blog-detail', compact('blog', 'tags', 'recent'));
    }

    public function categoryBlog($id)
    {
    }

    public function tagBlog($id)
    {
    }

    public function contact()
    {
        return view('contact');
    }
}
