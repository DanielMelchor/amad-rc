<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class vivienda extends Model
{
    protected $table = 'viviendas';
    protected $fillable = ['id', 'direccion', 'empresa_id', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
