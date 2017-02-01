<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalty extends Model
{
  use SoftDeletes;
  protected $table = 'tblpenalty';
  protected $primaryKey = 'strPenaCode';
  protected $fillable = ['strPenaName', 'strPenaPenaTypeCode','txtPenaDesc','dblPenaFee'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strPenaCode' => 'string'];

  public function PenaltyType()
  {
      return $this->belongsTo('App\PenaltyType', 'strPenaPenaTypeCode')->withTrashed();

  }
}
