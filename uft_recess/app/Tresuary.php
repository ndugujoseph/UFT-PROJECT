<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tresuary
 *
 * @package App
 * @property string $date
 * @property decimal $total
 * @property decimal $amount
*/
class Tresuary extends Model
{
    use SoftDeletes;

    protected $fillable = ['date','amount', 'total'];
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
     * Set attribute to money format
     * @param $input
     */
    public function setTotalAttribute($input)
    {
        $this->attributes['total'] = $input ? $input : null;
    }
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
       
}
