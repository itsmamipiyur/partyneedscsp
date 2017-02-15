<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemDinnerware extends Model
{
    //
    use SoftDeletes;
  protected $table = 'tblItemDinnerware';
  protected $primaryKey = 'itemCode';
  protected $fillable = ['dinnerwareTypeCode','quantity'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemCode' => 'string'];
}
