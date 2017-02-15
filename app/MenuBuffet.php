<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuBuffet extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblMenuBuffet';
  protected $primaryKey = 'menuCode';
  protected $fillable = ['quantityRatioCode','price'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['menuCode' => 'string'];
}
