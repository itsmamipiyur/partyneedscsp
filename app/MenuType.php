<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
  use SoftDeletes;
  protected $table = 'tblmenutype';
  protected $primaryKey = 'strMenuTypeCode';
  protected $fillable = ['strMenuTypeName', 'txtMenuTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strMenuTypeCode' => 'string'];
}
