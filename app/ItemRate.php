<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemRate extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblItemRate';
  protected $primaryKey = 'itemRateCode';
  protected $fillable = ['itemCode','amount','unitCode', 'effectiveDate'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemRateCode' => 'string'];

   public function item()
  {
      return $this->belongsTo('App\Item', 'itemCode');
  }
}
