<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
  use SoftDeletes;
  protected $table = 'tbleventtype';
  protected $primaryKey = 'strEvenTypeCode';
  protected $fillable = ['strEvenTypeName', 'txtEvenTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEvenTypeCode' => 'string'];
}
