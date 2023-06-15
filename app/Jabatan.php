<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table ='jabatan';
    protected $fillable =['code','nama_jabatan'];
}
