<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('backend.report.laporan');
    }

    public function generatePDF(Request $request)
    {
        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        $start = Carbon::parse($request->start)->format('Y-m-d');
        $end = Carbon::parse($request->end)->format('Y-m-d');

        $transaksi = Transaksi::selectRaw('tgl_pinjam, SUM(harga+denda) as total, SUM(harga) as sewa, SUM(denda) as total_denda')
            ->groupBy('tgl_pinjam')
            ->where('status', 2)
            ->whereBetween('tgl_pinjam', [$start, $end])
            ->get();

        $pdf = PDF::loadView('pdf.report', compact('transaksi', 'start', 'end'));
        return $pdf->stream();
    }
}
