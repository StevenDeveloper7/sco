<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    //protected $guarded = [];

    public function id_estado(){
        return $this->belongsTo(Estado::class, 'id');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "laboratorios";

    /**
     * @var array
     */
    protected $fillable = [
        'nit','nombre','telefono','direccion','email','id_estado'
    ];
}
