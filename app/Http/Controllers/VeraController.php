<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vera;

class VeraController extends Controller
{
    public function create()
    {
        $jenis_layanan = [
            'LPJ BULANAN',
            'USER E-REKONSILIASI & LK',
            'PENYESUAIAN PAGU',
            'IJIN PENGGUNAAN MP SISA TAHUN LALU',
            'KETERANGAN SALDO AKHIR KAS BLU',
            'MPHL BJS',
            'PERMOHONAN SKTB',
            'PENERIMAAN LK SATKER',
            'REKONSILIASI LK & LPJ'
        ];

        return view('user.layanan-vera.create', compact('jenis_layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'nullable|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/vera', 'public');

        Vera::create([
            'id_satker' => $request->id_satker,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil dikirim.');
    }
}
