<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peticion extends Model
{
    use HasFactory;

    protected $table = 'peticions';     //---- Este modelo protegera la tabla 'peticions'
    protected $guarded = [];

    public function user(): BelongsTo   //---- Relacion BelongsTo con Users ya que, 'las peticiones pertenecen a los usuarios'
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
