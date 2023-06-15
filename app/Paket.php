<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table ='paket';
    protected $fillable =['code','nama_paket','harga','ticket','activedate'];
}
