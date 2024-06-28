<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $monthly = Transaksi::whereBetween('tgl_pinjam', [$start, $end])->where('status', 2)
            ->get()->sum(function ($item) {
                return $item->harga + $item->denda;
            });

        $perTransaksi = Transaksi::where('pay', 'success')->sum('harga');

        $dipesan = Transaksi::where('status', 0)->count();
        $disewakan = Transaksi::where('status', 1)->count();
        $dikembalikan = Transaksi::where('status', 2)->count();
        $dibatalkan = Transaksi::where('status', 3)->count();

        return view('backend.dashboard.index', compact('monthly', 'dipesan', 'disewakan', 'dikembalikan', 'dibatalkan', 'perTransaksi'));
    }

    public function getGrafikChart()
    {
        $month = [
            [
                'month' => 'Jan',
                'data' => 0
            ],
            [
                'month' => 'Feb',
                'data' => 0
            ],
            [
                'month' => 'Mar',
                'data' => 0
            ],
            [
                'month' => 'Apr',
                'data' => 0
            ],
            [
                'month' => 'Mey',
                'data' => 0
            ],
            [
                'month' => 'Jun',
                'data' => 0
            ],
            [
                'month' => 'Jul',
                'data' => 0
            ],
            [
                'month' => 'Aug',
                'data' => 0
            ],
            [
                'month' => 'Sep',
                'data' => 0
            ],
            [
                'month' => 'Oct',
                'data' => 0
            ],
            [
                'month' => 'Nov',
                'data' => 0
            ],
            [
                'month' => 'Dec',
                'data' => 0
            ],
        ];

        $start = Carbon::now()->format('Y') . '-01-01';
        $end = Carbon::now()->format('Y') . '-12-31';

        $transaksi = Transaksi::selectRaw('MONTH(tgl_pinjam) as bulan, SUM(harga+denda) as total')
            ->groupBy('bulan')
            ->whereBetween('tgl_pinjam', [$start, $end])
            ->get();

        foreach ($transaksi as $row) {
            $month[$row->bulan - 1]['data'] = $row->total;
        }

        return response()->json([
            'bulan' => collect($month)->pluck('month')->all(),
            'data' => collect($month)->pluck('data')->all()
        ]);
    }

    public function getPieChart()
    {
        $data = [
            [
                'label' => 'Produk',
                'data' => Produk::count()
            ],
            [
                'label' => 'Pelanggan',
                'data' => Pelanggan::count()
            ],
            [
                'label' => 'Transaksi',
                'data' => Transaksi::count()
            ]
        ];

        return response()->json($data);
    }
}
