<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemEquipment extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblItemEquipment';
  protected $primaryKey = 'itemCode';
  protected $fillable = ['equipmentTypeCode'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemCode' => 'string'];
}
