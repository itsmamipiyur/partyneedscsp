<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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

  public function scopeHour($query)
  {
    return $query->where('unitCode', '1')->get();
  }

  public function scopeDay($query)
  {
    return $query->where('unitCode', '2')->get();
  }

  public function scopeLatestHour($query)
  {
    return $query->where([
        ['unitCode', '1'],
        ['effectiveDate', '<=' , Carbon::now()]
      ])->orderBy('effectiveDate', 'desc')->first();
  }

  public function scopeLatestDay($query)
  {
    return $query->where([
        ['unitCode', '2'],
        ['effectiveDate', '<=' , Carbon::now()]
      ])->orderBy('effectiveDate', 'desc')->first();
  }
}
