<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora',
        'fecha',
        'user_id',
        'tiempo_id'
    ];

    public function CitaServicio(){
        return $this->hasMany('App\Models\CitaServicio');
    }

    public function TiempoFK(){
        return $this->belongsTo('App\Models\Tiempo');
    }
}
