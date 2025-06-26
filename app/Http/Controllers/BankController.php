<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function create()
    {
        $jenis_layanan = [
            'LAYANAN KONFIRMASI PENERIMAAN',
            'LAPORAN SALDO REKENING',
            'BAR REKENING MILIK SATKER LINGKUP K/L',
            'RETUR',
            'KOREKSI PENERIMAAN',
            'KONFIRMASI SETORAN'
        ];

        return view('user.layanan-bank.create', compact('jenis_layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'required|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/bank', 'public');

        Bank::create([
            'id_satker' => $request->id_satker,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Layanan Bank berhasil dikirim.');
    }
}
