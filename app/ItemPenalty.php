<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPenalty extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblItemPenalty';
  protected $primaryKey = 'itemPenaltyCode';
  protected $fillable = ['itemCode', 'minQuantity', 'penaltyType', 'amount', 'effectiveDate'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['itemPenaltyCode' => 'string'];
}
