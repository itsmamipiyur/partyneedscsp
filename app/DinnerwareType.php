<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DinnerwareType extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblDinnerwareType';
  protected $primaryKey = 'dinnerwareTypeCode';
  protected $fillable = ['dinnerwareTypeName','dinnerwareTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['dinnerwareTypeCode' => 'string'];
}
