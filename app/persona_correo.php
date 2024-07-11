<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class persona_correo extends Model
{
    protected $table = 'persona_correos';
    protected $fillable = ['id', 'persona_id', 'email', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    use Userstamps;
}
