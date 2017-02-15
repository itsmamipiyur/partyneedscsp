<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuDetail extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblMenuDetail';
  protected $primaryKey = 'menuCode','dishCode';
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['menuCode','dishCode' => 'string'];
}
