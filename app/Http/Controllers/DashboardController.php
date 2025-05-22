<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $kelasResponse = Http::get('http://localhost:8080/kelas');
        $prodiResponse = Http::get('http://localhost:8080/prodi');
        
        $kelasCount = count($kelasResponse->json());
        $prodiCount = count($prodiResponse->json());
        
        return view('dashboard.index', compact('kelasCount', 'prodiCount'));
    }
}
