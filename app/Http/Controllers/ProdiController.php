<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdiController extends Controller
{
    protected $apiUrl = 'http://localhost:8080/prodi';

    public function index()
    {
        try {
            $response = Http::get($this->apiUrl);
            
            if (!$response->successful()) {
                return view('prodi.index', [
                    'prodi' => [],
                    'error' => 'Failed to fetch data: ' . $response->status() . ' ' . $response->body()
                ]);
            }
            
            $prodi = $response->json();
            
            // If response is not an array, handle it
            if (!is_array($prodi)) {
                return view('prodi.index', [
                    'prodi' => [],
                    'error' => 'Invalid response format: ' . json_encode($prodi)
                ]);
            }
            
            return view('prodi.index', compact('prodi'));
        } catch (\Exception $e) {
            return view('prodi.index', [
                'prodi' => [],
                'error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:8',
            'nama_prodi' => 'required|string|max:100',
        ]);

        $data = [
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
        ];
        
        // Convert data to JSON format for the API
        $jsonData = json_encode($data);
        
        // Use content-type application/json for the request
        $response = Http::asJson()->post($this->apiUrl, $data);
        
        // Debug information
        $debug = [
            'endpoint' => $this->apiUrl,
            'request_data' => $data,
            'response_status' => $response->status(),
            'response_body' => $response->body(),
        ];
        
        \Log::info('Prodi Store Debug', $debug);
        
        if ($response->successful()) {
            return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan Program Studi: ' . $response->body())
                    ->with('debug', $debug);
    }

    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");
        $prodi = $response->json();

        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100',
        ]);

        $data = [
            'nama_prodi' => $request->nama_prodi,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->put("{$this->apiUrl}/{$id}", $data);

        if ($response->successful()) {
            return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui Program Studi: ' . $response->body());
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus Program Studi');
    }
}
