# 🚀 SI-KRS Frontend - Laravel + Tailwind CSS
Ini adalah proyek antarmuka pengguna (frontend) berbasis Laravel 10 dan Tailwind CSS yang dirancang untuk terhubung dengan backend REST API (dibangun dengan CodeIgniter 4). Aplikasi ini digunakan untuk mengelola data Mahasiswa, Program Studi (Prodi), dan Kelas.

- [Backend SI-KRS Github](https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend)
- [Database SI-KRS Github](https://github.com/WindyAnggitaPutri/SI_KRS_Database)

# ⚙ Teknologi
- Laravel 10
- Tailwind CSS
- Laravel HTTP Client (untuk konsumsi API)
- Vite (build asset frontend)
- REST API (CodeIgniter 4)

# 🧩 Struktur Sistem
Frontend Laravel ini tidak menyimpan data ke database lokal. Semua proses Create, Read, Update, dan Delete dilakukan melalui REST API backend CodeIgniter.

# 🚀 SETUP BACKEND
1. Clone Repository BE
```
git clone https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend.git
```
```
- cd nama-file
```
2. Install Dependency CodeIgniter
``
composer install
``
4. Copy File Environment
```
cp .env.example .env
```
6. Menjalankan CodeIgniter
```
php spark serve
```
8. Cek EndPoint menggunakan Postman
- Kelas :
```
- GET → http://localhost:8080/kelas / http://localhost:8080/kelas/{id}
- POST → http://localhost:8080/kelas
- PUT → http://localhost:8080/kelas/{id}
- DELETE → http://localhost:8080/kelas/{id}
```
- Prodi :
```
- GET → http://localhost:8080/prodi / http://localhost:8080/prodi/{id}
- POST → http://localhost:8080/prodi
- PUT → http://localhost:8080/prodi/{id}
- DELETE → http://localhost:8080/prodi/{id}
```

# 🚀 SETUP FRONTEND
1. Install Laravel
Install di CMD atau Terminal
```
composer create-priject laravel/laravel nama-project
```

2. Install Dependency Laravel
```
composer install
```
3. Copy File Environment
```
cp .env.example .env
```
4. Set .env untuk Non-Database App
```
APP_NAME=Laravel
APP_URL=http://localhost:8000
SESSION_DRIVER=file
```

5. Cara Menjalankan Laravel server
```
php artisan serve
```

## 🧩  Routes
```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Kelas Routes
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Prodi Routes
Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
```

## 🧩  Controllers
1. KelasController.php
```
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

```

2. ProdiController.php
```
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

```

