<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MenuRate extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tblMenuRate';
  	protected $primaryKey = 'menuRateCode';
  	protected $fillable = ['menuCode', 'servingType', 'amount', 'effectiveDate'];
  	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  	protected $casts = ['menuRateCode' => 'string'];

  	public function menu()
  	{
  		return $this->belongsTo('App\Menu', 'menuCode')->withTrashed();
  	}

    public function scopeBuffet($query)
    {
      return $query->where('servingType', '1')->get();
    }

    public function scopeSet($query)
    {
      return $query->where('servingType', '2')->get();
    }

    public function scopeLatestBuffet($query)
    {
      return $query->where([
          ['servingType', '1'],
          ['effectiveDate', '<=' , Carbon::now()]
        ])->orderBy('effectiveDate', 'desc')->first();
    }

    public function scopeLatestSet($query)
    {
      return $query->where([
          ['servingType', '2'],
          ['effectiveDate', '<=' , Carbon::now()]
        ])->orderBy('effectiveDate', 'desc')->first();
    }
}
