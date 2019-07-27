<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class WellWishers
 *
 * @package App
 * @property string $first_name
 * @property string $date
 * @property double $amount
 * @property string $district
*/
class WellWishers extends Model
{
    protected $fillable = ['first_name', 'date', 'amount', 'district_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        if ($input != '') {
            $this->attributes['amount'] = $input;
        } else {
            $this->attributes['amount'] = null;
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDistrictIdAttribute($input)
    {
        $this->attributes['district_id'] = $input ? $input : null;
    }
    
    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id')->withTrashed();
    }
    
}
