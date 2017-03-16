<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ItemDinnerware extends Model
{
    //
    //use SoftDeletes;
 	  protected $table = 'tblItemDinnerware';
  	protected $primaryKey = 'itemCode';
  	protected $fillable = ['dinnerwareTypeCode'];
  	//protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  	protected $casts = ['itemCode' => 'string'];
    public $timestamps = false;

  	public function dinnerwareType()
	  {
	      return $this->belongsTo('App\DinnerwareType', 'dinnerwareTypeCode')->withTrashed();
	  }
}
