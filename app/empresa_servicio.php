<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class empresa_servicio extends Model
{
    protected $table = 'empresa_servicios';
    protected $fillable = ['id', 'empresa_id', 'servicio_id', 'valor', 'dia', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
