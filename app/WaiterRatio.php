<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaiterRatio extends Model
{
  use SoftDeletes;
  protected $table = 'tblWaiterRatio';
  protected $primaryKey = 'waiterRatioCode';
  protected $fillable = ['waiterRatioMinPax','waiterRatioMaxPax','waiterRatioWaiterCount'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['waiterRatioCode' => 'string'];
}
