<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenaltyItem extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblPenaltyItem';
  protected $primaryKey = 'penaltyItemCode';
  protected $fillable = ['itemCode', 'minLevel', 'penaltyType', 'amount'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['penaltyCode' => 'string'];
}
