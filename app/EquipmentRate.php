<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentRate extends Model
{
  use SoftDeletes;
  protected $table = 'tblequipmentrate';
  protected $primaryKey = 'strEquiRateCode';
  protected $fillable = ['strEquiRateEquiCode', 'dblEquiRateAmount','strEquiRateUnitCode'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEquiRateCode' => 'string', 'dblEquiRateAmount' => 'string'];

  public function Equipment()
  {
      return $this->belongsTo('App\Equipment', 'strEquiRateEquiCode')->withTrashed();

  }

  public function Unit()
  {
      return $this->belongsTo('App\Unit', 'strEquiRateUnitCode')->withTrashed();

  }
}
