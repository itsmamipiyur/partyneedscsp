<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decor extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblDecor';
  protected $primaryKey = 'decorCode';
  protected $fillable = ['decorName','decorType','decorDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['decorCode' => 'string'];
}
