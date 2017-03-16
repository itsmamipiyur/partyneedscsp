<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemEquipment extends Model
{
    //
  //use SoftDeletes;
  protected $table = 'tblItemEquipment';
  protected $primaryKey = 'itemCode';
  protected $fillable = ['equipmentTypeCode'];
  protected $casts = ['itemCode' => 'string'];

  public $timestamps = false;
  public function equipmentType()
	  {
	      return $this->belongsTo('App\EquipmentType', 'equipmentTypeCode')->withTrashed();
	  }
}
