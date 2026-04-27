<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Unguarded]
class Oferta extends Model
{
    /** @use HasFactory<\Database\Factories\OfertaFactory> */
    use HasFactory;

    use SoftDeletes;

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }
    
    public function servico(): HasOne
    {
        return $this->hasOne(Servico::class);
    }
}
