<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryRelease extends Model
{
    //
    protected $table = 'tblInventoryRelease';
  	protected $primaryKey = 'inventoryReleaseCode';
  	protected $fillable = ['itemCode', 'quantity'];
  	protected $casts = ['inventoryReleaseCode' => 'string'];
  	public $timestamps = false;
}
