<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBahanBaku extends Model
{
    use HasFactory;
    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}