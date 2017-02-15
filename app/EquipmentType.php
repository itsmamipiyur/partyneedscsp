<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentType extends Model
{
  use SoftDeletes;
  protected $table = 'tblEquipmentType';
  protected $primaryKey = 'equipmentTypeCode';
  protected $fillable = ['equipmentTypeName', 'equipmentTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['equipmentTypeCode' => 'string'];
}
