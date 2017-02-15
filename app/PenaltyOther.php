<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenaltyOther extends Model
{
    //
  use SoftDeletes;
  protected $table = 'tblPenaltyOther';
  protected $primaryKey = 'penaltyCode';
  protected $fillable = ['amount'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['penaltyCode' => 'string'];
}
