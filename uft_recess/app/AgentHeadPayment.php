<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class AgentHeadPayment
 *
 * @package App
 * @property string $date
 * @property decimal $highest_erollment
 * @property decimal $lowest_erollment
*/
class AgentHeadPayment extends Model
{
    protected $fillable = ['date', 'highest_erollment', 'lowest_erollment'];
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
    public function setHighestErollmentAttribute($input)
    {
        $this->attributes['highest_erollment'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setLowestErollmentAttribute($input)
    {
        $this->attributes['lowest_erollment'] = $input ? $input : null;
    }
    
}
