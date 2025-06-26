<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mski;

class MskiController extends Controller
{
    public function create()
    {
        $jenis_layanan = [
            'PERMOHONAN TUP',
            'PERMOHONAN KIPS',
            'PENDAFTARAN OM SPAN',
            'PENDAFTARAN DAN PENONAKTIFAN PIN PPSPM',
            'PENDAFTARAN DAN PENONAKTIFAN USER SAKTI',
            'PENGAJUAN RPD',
            'DISPENSASI GUP TAMBAHAN',
            'CUSTOMER SERVICE',
            'PENDAFTARAN INJENT'
        ];

        return view('user.layanan-mski.create', compact('jenis_layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'required|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/mski', 'public');

        Mski::create([
            'id_satker' => $request->id_satker,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Layanan MSKI berhasil dikirim.');
    }
}
