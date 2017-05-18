<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
  protected $table = 'tblEvent';
  protected $primaryKey = 'eventCode';
  protected $fillable = ['eventTitle', 'eventDesc', 'eventStart', 'eventEnd', 'eventAddress', 'deliveryId'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['eventCode' => 'string'];

  public function decors()
  {
      return $this->belongsToMany('App\Decor', 'tblEventDecor',  'eventCode', 'decorCode');
  }

  public function types()
  {
      return $this->belongsToMany('App\EventType', 'tblEventTypes',  'eventCode', 'eventTypeCode');
  }

  public function customer()
  {
      return $this->belongsTo('App\Customer', 'customerCode');
  }

  public function delivery()
  {
      return $this->belongsTo('App\Delivery', 'deliveryId');
  }

  public function orders()
  {
    return $this->hasMany('App\EventOrder', 'eventCode');
  }
}
