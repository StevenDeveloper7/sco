<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
      /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "tipo_documentos";

    /**
     * @var array
     */
    protected $fillable = [
        'nombres', 'descripcion'
    ];
}
