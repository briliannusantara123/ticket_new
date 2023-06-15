<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_relation extends Model
{
    protected $table ='project_relation';
    protected $fillable =['id_project','id_user','email','id_jabatan','default_consultant'];
}
