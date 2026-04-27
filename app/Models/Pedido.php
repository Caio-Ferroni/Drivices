<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Unguarded]
class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cupon(): BelongsTo
    {
        return $this->belongsTo(Cupon::class);
    }

    public function ofertas(): HasMany
    {
        return $this->hasMany(Oferta::class);
    }

    public function servico(): HasOne
    {
        return $this->hasOne(Servico::class);
    }
}
