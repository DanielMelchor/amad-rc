<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['id', 'primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno', 'apellido_casada', 'cui', 'estado', 'genero'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
