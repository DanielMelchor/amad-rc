<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class persona_telefono extends Model
{
    protected $table = 'persona_telefonos';
    protected $fillable = ['id', 'persona_id', 'tipo_numero', 'codigo_area', 'numero', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
