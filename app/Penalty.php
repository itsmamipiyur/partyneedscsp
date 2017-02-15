<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalty extends Model
{
  use SoftDeletes;
  protected $table = 'tblPenalty';
  protected $primaryKey = 'penaltyCode';
  protected $fillable = ['penaltyDesc','penaltyType'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['penaltyCode' => 'string'];

  public function PenaltyType()
  {
      return $this->belongsTo('App\PenaltyType', 'strPenaPenaTypeCode')->withTrashed();

  }
}
