<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['id_kelas', 'nama_kelas'];
    
    // This model is used for type-hinting and structure only
    // The actual data comes from the API
}
