<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manpower extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblManpower';
  protected $primaryKey = 'manpowerCode';
  protected $fillable = ['manpowerPosition','manpowerDesc','manpowerRate'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['manpowerCode' => 'string'];
}
