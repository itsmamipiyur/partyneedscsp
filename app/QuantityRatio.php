<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuantityRatio extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblQuantityRatio';
  protected $primaryKey = 'quantityRatioCode';
  protected $fillable = ['quantityRatioMinPax','quantityRatioMaxPax','quantityRatioKilo'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['quantityRatioCode' => 'string'];
}
