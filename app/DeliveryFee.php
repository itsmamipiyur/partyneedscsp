<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryFee extends Model
{
  use SoftDeletes;
  protected $table = 'tbldelivery';
  protected $primaryKey = 'strDeliCode';
  protected $fillable = ['strDeliName', 'txtDeliDesc','dblDeliFee'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strDeliCode' => 'string'];
}
