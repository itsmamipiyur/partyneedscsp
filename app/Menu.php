<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  use SoftDeletes;
  protected $table = 'tblmenu';
  protected $primaryKey = 'strMenuCode';
  protected $fillable = ['strMenuName', 'txtMenuDesc', 'strMenuMenuTypeCode','strMenuFoodCateCode'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strMenuCode' => 'string'];

  public function MenuType()
  {
      return $this->belongsTo('App\MenuType', 'strMenuMenuTypeCode')->withTrashed();

  }
  public function FoodCategory()
  {
      return $this->belongsTo('App\FoodCategory', 'strMenuFoodCateCode')->withTrashed();
  }

}
