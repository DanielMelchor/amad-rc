<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class pais extends Model
{
    protected $table = 'paises';
    protected $fillable = ['id', 'nombre', 'abreviatura', 'codigo', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
