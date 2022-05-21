<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Scopes\UsuarioScope;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['producto', 'descripcion', 'categoria', 'user_id'];

    /*protected static function booted()
    {
        static::addGlobalScope(new UsuarioScope);
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class);
    }

    protected function producto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
