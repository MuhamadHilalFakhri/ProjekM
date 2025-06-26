<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vera;
use App\Models\LayananPd;
use App\Models\Mski;
use App\Models\Bank;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data dari masing-masing model
        $veraRequests = Vera::latest()->get();
        $pdRequests = LayananPd::latest()->get();
        $mskiRequests = Mski::latest()->get();
        $bankRequests = Bank::latest()->get();

        // Gabungkan semua data untuk tab "Semua"
        $allRequests = new Collection();
        
        $veraRequests->each(function ($item) use ($allRequests) {
            $item->layanan_type = 'Vera';
            $allRequests->push($item);
        });
        
        $pdRequests->each(function ($item) use ($allRequests) {
            $item->layanan_type = 'PD';
            $allRequests->push($item);
        });
        
        $mskiRequests->each(function ($item) use ($allRequests) {
            $item->layanan_type = 'MSKI';
            $allRequests->push($item);
        });
        
        $bankRequests->each(function ($item) use ($allRequests) {
            $item->layanan_type = 'Bank';
            $allRequests->push($item);
        });

        // Urutkan berdasarkan created_at terbaru
        $allRequests = $allRequests->sortByDesc('created_at');

        return view('user.dashboard', compact(
            'veraRequests',
            'pdRequests',
            'mskiRequests',
            'bankRequests',
            'allRequests'
        ));
    }
}