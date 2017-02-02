<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
  use SoftDeletes;
  protected $table = 'tblunit';
  protected $primaryKey = 'strUnitCode';
  protected $fillable = ['strUnitName','txtUnitDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strUnitCode' => 'string'];
}
