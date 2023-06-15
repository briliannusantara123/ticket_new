<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestheader extends Model
{
    protected $table ='request_header';
    protected $fillable =['code','id_company','description','user_id','status','message_client','message_admin','email_client','email_consultant','priority','ticket','dead_line','id_developer','ticket_paid','id_project'];

    public function requestlines()
    {
        return $this->belongsTo(Requestlines::class, 'id_header', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'idc');
    }
}
