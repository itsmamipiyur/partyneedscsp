<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishType extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblDishType';
  protected $primaryKey = 'dishTypeCode';
  protected $fillable = ['dishTypeName','dishTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['dishTypeCode' => 'string'];
}
