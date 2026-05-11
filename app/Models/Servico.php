<?php

namespace App\Models;

use Database\Factories\ServicoFactory;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Unguarded]
class Servico extends Model
{
    /** @use HasFactory<ServicoFactory> */
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

    public function getProfessionalAttribute()
    {
        return $this->oferta?->professional;
    }

    public function getUserAttribute()
    {
        return $this->pedido?->user;
    }
}
