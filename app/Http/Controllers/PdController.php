<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananPd;

class PdController extends Controller
{
    public function create()
    {
        $jenis_layanan = [
            'DPP PPNPN',
            'DISPENSASI',
            'SKKP PINDAH',
            'SKKP PENSIUN',
            'Pembatalan Kontrak'
        ];

        return view('user.layanan-pd.create', compact('jenis_layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'required|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/pd', 'public');

        LayananPd::create([
            'id_satker' => $request->id_satker,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Layanan PD berhasil dikirim.');
    }
}
