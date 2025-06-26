<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mski;
use Illuminate\Support\Facades\Auth;

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

        // Kirim NIP user yang login ke view
        return view('user.layanan-mski.create', [
            'jenis_layanan' => $jenis_layanan,
            'userNip' => Auth::user()->nip
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'required|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/layanan', 'public');

        Mski::create([
            'id_satker' => Auth::user()->nip, // Gunakan NIP user yang login
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            'user_id' => Auth::id() // Simpan ID user yang membuat pengajuan
        ]);

        return redirect()->back()->with('success', 'Layanan MSKI berhasil dikirim.');
    }
}