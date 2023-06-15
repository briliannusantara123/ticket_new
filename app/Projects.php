<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
   	protected $table ='projects';
    protected $fillable =['code','id_company','nama_projects','ticket','ticket_used','ticket_active'];
}
