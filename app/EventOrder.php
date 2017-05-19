<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOrder extends Model
{
    //
  protected $table = 'tblEventOrder';
  protected $primaryKey = 'eventOrderCode';
  protected $fillable = ['eventCode', 'status'];
  protected $dates = ['created_at', 'updated_at'];
  protected $casts = ['eventOrderCode' => 'string'];

  public function menus()
  {
  	return $this->belongsToMany('App\Menu', 'tblEventOrderDetail', 'eventOrderCode', 'menuCode')->withPivot('pax', 'servingType');
  }

  public function event()
  {
    return $this->belongsTo('App\Event', 'eventCode');
  }

  public function rates()
  {
    return $this->belongsToMany('App\MenuRate', 'tblEventOrderDetail', 'eventOrderCode', 'menuRateCode');
  }

  public function getSubtotalAttribute() {
    return $this->rates()->select(\DB::raw('sum( tblEventOrderDetail.pax * tblMenuRate.amount ) as subtotal'))->pluck('subtotal')->first();
  }
}
