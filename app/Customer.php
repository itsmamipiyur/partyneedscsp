<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'tblCustomer';
	protected $primaryKey = 'customerCode';
	protected $fillable = ['customerFirst','customerMiddle','customerLast', 'customerAddress', 'customerContact'];
	protected $dates = ['created_at', 'updated_at'];
	protected $casts = ['customerCode' => 'string'];
}
