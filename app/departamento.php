<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['id', 'pais_id', 'nombre', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
