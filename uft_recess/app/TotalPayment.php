<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class TotalPayment
 *
 * @package App
 * @property string $date
 * @property decimal $agent_low
 * @property decimal $agent_high
 * @property decimal $agent_head_low
 * @property decimal $agent_head_high
*/
class TotalPayment extends Model
{
    protected $fillable = ['date', 'agent_low', 'agent_high', 'agent_head_low', 'agent_head_high'];
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
    public function setAgentLowAttribute($input)
    {
        $this->attributes['agent_low'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAgentHighAttribute($input)
    {
        $this->attributes['agent_high'] = $input ? $input : null;
    }

     /**
     * Set attribute to money format
     * @param $input
     */
    public function setAgentHeadLowAttribute($input)
    {
        $this->attributes['agent_head_low'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAgentHeadHighAttribute($input)
    {
        $this->attributes['agent_head_high'] = $input ? $input : null;
    }
    
}
