<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vera;
use Illuminate\Support\Facades\Auth;

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

        // Kirim NIP user ke view
        $userNip = Auth::user()->nip;
        
        return view('user.layanan-vera.create', compact('jenis_layanan', 'userNip'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_satker' => 'required|string',
            'jenis_layanan' => 'required|string',
            'keterangan' => 'nullable|string',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048',
        ]);

        $filePath = $request->file('file_upload')->store('uploads/layanan', 'public');

        Vera::create([
            'id_satker' => Auth::user()->nip, // Gunakan NIP user yang login
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            'user_id' => Auth::id() // Simpan ID user yang membuat pengajuan
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil dikirim.');
    }
}