<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
