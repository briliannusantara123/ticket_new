<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table ='transaksi';
    protected $fillable =['code','id_company','invoice','description','id_paket','jumlah_ticket','activedate','id_support','status','message_client','message_admin','harga','email_client','email_company','id_project','ticket_active','ticket','ticket_used'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'idc');
    }
}
