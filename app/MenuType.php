<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuType extends Model
{
  use SoftDeletes;
  protected $table = 'tblmenutype';
  protected $primaryKey = 'strMenuTypeCode';
  protected $fillable = ['strMenuTypeName', 'txtMenuTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strMenuTypeCode' => 'string'];
}
