<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Hanya kolom ID yang tidak boleh diisi
    protected $guarded = ['id'];

    // table Menu berelasi dengan table Kategori, yang mana table Menu adalah N (Relasi 1 to N)
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
