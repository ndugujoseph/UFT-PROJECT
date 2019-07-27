<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Members
 *
 * @package App
 * @property string $name
 * @property string $district
 * @property string $recommender_agent
 * @property string $recommender_member
 * @property string $date
 * @property string $member_id
 * @property string $gender
 * @property integer $recommendees
*/
class Members extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'district', 'recommender_agent', 'recommender_member', 'date', 'member_id', 'gender', 'recommendees'];
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
    public function setRecommendeesAttribute($input)
    {
        $this->attributes['recommendees'] = $input ? $input : null;
    }
    
}
