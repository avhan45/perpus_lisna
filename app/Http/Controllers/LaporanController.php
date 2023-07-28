<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function buku()
    {
        return view('laporan.buku');
    }

    public function bukuPdf()
    {

        $datas = Buku::all();
        // dd($datas);
        $pdf = Pdf::loadView('laporan.buku_pdf', compact('datas'));
        return $pdf->download('laporan_buku' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function transaksi()
    {
        return view('laporan.transaksi');
    }

    public function transaksiPdf(Request $request)
    {
        $q = Transaksi::query();

        if ($request->get('status')) {
            if ($request->get('status') == 'pinjam') {
                $q->where('status', 'pinjam');
            } else {
                $q->where('status', 'kembali');
            }
        }

        if (Auth::user()->level == 'user') {
            $q->where('anggota_id', Auth::user()->anggota->id);
        }

        $datas = $q->get();

        // return view('laporan.transaksi_pdf', compact('datas'));
        $pdf = Pdf::loadView('laporan.transaksi_pdf', compact('datas'));
        return $pdf->download('laporan_transaksi_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
