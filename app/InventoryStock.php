<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    //
    protected $table = 'tblInventoryStock';
  	protected $primaryKey = 'inventoryStockCode';
  	protected $fillable = ['itemCode', 'quantity'];
  	protected $casts = ['inventoryStockCode' => 'string'];
  	public $timestamps = false;
}
