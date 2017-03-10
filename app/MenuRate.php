<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuRate extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tblMenuRate';
  	protected $primaryKey = 'menuRateCode';
  	protected $fillable = ['menuCode', 'servingType', 'quantity', 'amount'];
  	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  	protected $casts = ['menuRateCode' => 'string'];

  	public function menu()
  	{
  		return $this->belongsTo('App\Menu', 'menuCode')->withTrashed();
  	}
}
