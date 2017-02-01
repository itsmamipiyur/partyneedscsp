<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
  use SoftDeletes;
  protected $table = 'tblequipment';
  protected $primaryKey = 'strEquiCode';
  protected $fillable = ['strEquiName', 'strEquiEquiTypeCode','txtEquiDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEquiCode' => 'string'];


  public function EquipmentType()
  {
      return $this->belongsTo('App\EquipmentType', 'strEquiEquiTypeCode')->withTrashed();

  }
}
