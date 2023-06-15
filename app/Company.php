<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table ='company';
    protected $primaryKey = 'idc';
    protected $fillable =['code','nama','email','telp','alamat','ticket','ticket_used','ticket_active','notif'];
    public function requestheader(){
    	return $this->hasMany('App\Requestheader', 'id_company', 'idc');
    }
    public function transaksi(){
    	return $this->hasMany('App\Transaksi', 'id_company', 'idc');
    }
    public function requestlines(){
    	return $this->hasMany('App\Requestlines', 'id_company', 'idc');
    }
    public function user(){
        return $this->hasMany('App\User', 'id_company', 'idc');
    }
}
