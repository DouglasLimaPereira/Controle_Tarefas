<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tarefa',
        'data_conclusao',
        'descricao',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
