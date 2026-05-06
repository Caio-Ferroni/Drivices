<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\Unguarded;

#[Unguarded]
class Servico extends Model
{
    /** @use HasFactory<\Database\Factories\ServicoFactory> */
    use HasFactory;

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }

    public function relatorio(): HasOne
    {
        return $this->hasOne(Relatorio::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
    
}
