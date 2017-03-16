<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Dish;


class Menu extends Model
{
  use SoftDeletes;
  protected $table = 'tblMenu';
  protected $primaryKey = 'menuCode';
  protected $fillable = ['menuName', 'menuDesc',];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['menuCode' => 'string'];

  public function dishes()
  {
      return $this->belongsToMany('App\Dish', 'tblMenuDish',  'menuCode', 'dishCode');
  }

  public function rates()
  {
    return $this->hasMany('App\MenuRate', 'menuCode');
  }

  public function scopeAvailableDishes($query, $id)
  {
      $ids = \DB::table('tblMenuDish')->where('menuCode', '=', $id)->pluck('dishCode');
      return Dish::whereNotIn('dishCode', $ids)->get();
  }
}
