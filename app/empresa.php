<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class empresa extends Model
{
    protected $table = 'empresas';
    protected $fillable = ['id', 'razon_social', 'nombre_comercial', 'direccion', 'telefonos', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
