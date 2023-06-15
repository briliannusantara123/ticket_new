<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestlines extends Model
{
    protected $table ='request_lines';
    protected $primaryKey = 'idl';
    protected $fillable =['code','id_header','id_company','id_project','description','status','id_developer','date_solve','date_close','gambar','email_client','email_consultant','message_testing','date_cancel','user_id','solve_by'];

   public function requestheader(){
    	return $this->hasMany('App\Requestheader', 'id_header', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_developer', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'idc');
    }
}
