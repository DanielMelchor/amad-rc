<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class municipio extends Model
{
    protected $table = 'municipios';
    protected $fillable = ['id', 'departamento_id', 'nombre', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
