<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class persona_vivienda extends Model
{
    protected $table = 'persona_viviendas';
    protected $fillable = ['id', 'persona_id', 'vivienda_id', 'tipo_persona', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
