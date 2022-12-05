<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Hanya kolom ID yang tidak boleh diisi
    protected $guarded = ['id'];

    // table kategori berelasi dengan table menu, yang mana table kategori adalah 1 (Relasi 1 to N)
    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
