<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $fillable = ['nombre_categoria','descripcion_categoria'];
}
