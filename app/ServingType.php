<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServingType extends Model
{
  use SoftDeletes;
  protected $table = 'tblservetype';
  protected $primaryKey = 'strServTypeCode';
  protected $fillable = ['strServTypeName', 'txtServTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strServTypeCode' => 'string'];
}
