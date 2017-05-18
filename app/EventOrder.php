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
  	return $this->belongsToMany('App\Menu', 'tblEventOrderDetail', 'eventOrderCode', 'menuCode');
  }

  public function event()
  {
    return $this->belongsTo('App\Event', 'eventCode');
  }
}
