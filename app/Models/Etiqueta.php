<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function productos()
    {
        return $this->belongdToMany(Producto::class);
    }
}
