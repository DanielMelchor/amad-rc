<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class puesto extends Model
{
    protected $table = 'puestos';
    protected $fillable = ['id', 'nombre', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
