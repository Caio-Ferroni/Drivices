<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Denuncia extends Model
{
    /** @use HasFactory<\Database\Factories\DenunciaFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
        ->withTrashed()
        ->withDefault([
            'name' => 'Usuario Deletado',
            'email' => 'N/A',
        ]);
    }

    public function denunciado(): BelongsTo
    {
        return $this->belongsTo(User::class, 'denunciado_id');
    }
}
