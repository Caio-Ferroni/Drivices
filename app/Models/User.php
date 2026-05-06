<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable; // Se estiver usando 2FA
use Illuminate\Contracts\Auth\MustVerifyEmail;


#[Unguarded]
class User extends Authenticatable implements MustVerifyEmail // Verifique se está estendendo Authenticatable e NÃO Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    use TwoFactorAuthenticatable;
    

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function denunciasFeitas(): HasMany
    {
        return $this->hasMany(Denuncia::class, 'user_id');
    }

    public function denunciasRecebidas(): HasMany
    {
        return $this->hasMany(Denuncia::class, 'denunciado_id');
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function professional(): HasOne
    {
        return $this->hasOne(Professional::class);
    }

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }

    public function isProfessional(): bool
    {
        return $this->professional()->exists();
    }

    public function isAdmin(): bool
    {
        return $this->tipo === "Admin";
    }

    public function hasEndereco(){
        return $this->endereco ? true : false;
    }

}
