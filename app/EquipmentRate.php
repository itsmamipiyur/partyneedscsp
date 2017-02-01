<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentRate extends Model
{
  use SoftDeletes;
  protected $table = 'tblequipmentrate';
  protected $primaryKey = 'strEquiRateCode';
  protected $fillable = ['strEquiRateEquiCode', 'dblEquiRateAmount','intEquiRateUnit'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEquiRateCode' => 'string'];

}
