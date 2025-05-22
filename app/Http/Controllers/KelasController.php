<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelasController extends Controller
{
    protected $apiUrl = 'http://localhost:8080/kelas';

    public function index()
    {
        try {
            $response = Http::get($this->apiUrl);
            
            if (!$response->successful()) {
                return view('kelas.index', [
                    'kelas' => [],
                    'error' => 'Failed to fetch data: ' . $response->status() . ' ' . $response->body()
                ]);
            }
            
            $kelas = $response->json();
            
            // If response is not an array, handle it
            if (!is_array($kelas)) {
                return view('kelas.index', [
                    'kelas' => [],
                    'error' => 'Invalid response format: ' . json_encode($kelas)
                ]);
            }
            
            return view('kelas.index', compact('kelas'));
        } catch (\Exception $e) {
            return view('kelas.index', [
                'kelas' => [],
                'error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
        ]);

        $data = [
            'nama_kelas' => $request->nama_kelas,
        ];
        
        // Use content-type application/json for the request
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->apiUrl, $data);
        
        // Debug information
        $debug = [
            'endpoint' => $this->apiUrl,
            'request_data' => $data,
            'response_status' => $response->status(),
            'response_body' => $response->body(),
        ];
        
        \Log::info('Kelas Store Debug', $debug);
        
        if ($response->successful()) {
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan kelas: ' . $response->body())
                    ->with('debug', $debug);
    }

    public function edit($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");
            
            if (!$response->successful()) {
                return redirect()->route('kelas.index')->with('error', 'Failed to fetch kelas data: ' . $response->status() . ' ' . $response->body());
            }
            
            $kelasData = $response->json();
            
            // Debug the response
            \Log::info('Kelas Edit Response', ['response' => $kelasData]);
            
            // Check if response is an array and has data
            if (is_array($kelasData) && !empty($kelasData)) {
                // If it's a nested array with one item (common API response pattern)
                if (isset($kelasData[0]) && is_array($kelasData[0])) {
                    $kelas = $kelasData[0];
                } else {
                    $kelas = $kelasData;
                }
                
                // Ensure id_kelas exists
                if (!isset($kelas['id_kelas'])) {
                    // Try to find id_kelas in the response
                    foreach ($kelas as $key => $value) {
                        if (strtolower($key) === 'id' || strtolower($key) === 'id_kelas' || strtolower($key) === 'kelas_id') {
                            $kelas['id_kelas'] = $value;
                            break;
                        }
                    }
                    
                    // If still not found, use the $id parameter
                    if (!isset($kelas['id_kelas'])) {
                        $kelas['id_kelas'] = $id;
                    }
                }
                
                return view('kelas.edit', compact('kelas'));
            }
            
            return redirect()->route('kelas.index')->with('error', 'Invalid kelas data format received');
            
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
        ]);

        $data = [
            'id_kelas' => $id, // Include id_kelas in the data
            'nama_kelas' => $request->nama_kelas,
        ];

        // Debug information
        \Log::info('Kelas Update Request', ['id' => $id, 'data' => $data]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->put("{$this->apiUrl}/{$id}", $data);

        // Debug response
        \Log::info('Kelas Update Response', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        if ($response->successful()) {
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui kelas: ' . $response->body());
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus kelas');
    }
}
