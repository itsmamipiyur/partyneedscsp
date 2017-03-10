<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Item;

class RentalPackage extends Model
{
    //
	use SoftDeletes;
	protected $table = 'tblRentalPackage';
	protected $primaryKey = 'rentalPackageCode';
	protected $fillable = ['rentalPackageName', 'rentalPackageDesc', 'rentalPackageAmount', 'rentalPackageDuration', 'rentalPackageUnit'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $casts = ['rentalPackageCode' => 'string'];

	public function items(){
		return $this->belongsToMany('App\Item', 'tblRentalPackageDetail',  'rentalPackageCode', 'itemCode')->withPivot('quantity');
	}

	public function scopeAvailableItems($query, $id)
	{
	  $ids = \DB::table('tblRentalPackageDetail')->where('rentalPackageCode', '=', $id)->pluck('itemCode');
	  return Item::whereNotIn('itemCode', $ids)->get();
	}

	public function scopeQuantity($query, $id)
	{
	  $ids = \DB::table('tblRentalPackageDetail')->where('rentalPackageCode', '=', $id)->pluck('itemCode');
	  return Item::whereNotIn('itemCode', $ids)->get();
	}
}
