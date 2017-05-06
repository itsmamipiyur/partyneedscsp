<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblItem';
  protected $primaryKey = 'itemCode';
  protected $fillable = ['itemName','itemDesc','itemType','uomCode'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemCode' => 'string'];

  public function itemDinnerware()
  {
      return $this->hasOne('App\ItemDinnerware', 'itemCode', 'itemCode');
  }

  public function itemEquipment()
  {
      return $this->hasOne('App\ItemEquipment', 'itemCode', 'itemCode');
  }

  public function uom()
  {
      return $this->hasOne('App\UOM', 'uomCode');
  }

  public function rates()
  {
      return $this->hasMany('App\ItemRate', 'itemCode');
  }
}
