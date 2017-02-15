<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
  use SoftDeletes;
  protected $table = 'tblDelivery';
  protected $primaryKey = 'deliveryCode';
  protected $fillable = ['deliveryLocation','deliveryFee'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['deliveryCode' => 'string'];
}
