<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typesupport extends Model
{
    protected $table ='type_support';
    protected $fillable =['code','nama_support'];
}
