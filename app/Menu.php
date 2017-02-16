<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
  use SoftDeletes;
  protected $table = 'tblMenu';
  protected $primaryKey = 'menuCode';
  protected $fillable = ['menuName', 'menuType', 'menuDesc',];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['menuCode' => 'string'];

  public function dishes()
  {
      return $this->belongsToMany('App\Dish', 'tblMenuDetail',  'menuCode', 'dishCode');
  }
}
