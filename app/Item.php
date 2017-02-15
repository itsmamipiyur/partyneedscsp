<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblItem';
  protected $primaryKey = 'itemCode';
  protected $fillable = ['itemName','itemDesc','itemType','uomCode'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemCode' => 'string'];
}
