<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UOM extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblUOM';
  protected $primaryKey = 'uomCode';
  protected $fillable = ['uomName','uomDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['uomCode' => 'string'];
}
