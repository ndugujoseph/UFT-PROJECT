<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 * @package App\Models
 * @version June 27, 2019, 10:32 am UTC
 *
 * @property string      name
 * @property string      district
 * @property string      recommender_agent
 * @property string      recommender_member
 * @property string      date
 * @property string      member_id
 * @property string      gender
 * @property string      recommendees
 */
class Member extends Model
{
    use SoftDeletes;

    public $table = 'members';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'district',
        'recommender_agent',
        'recommender_member',
        'date',
        'member_id',
        'gender',
        'recommendees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'member_id' => 'string',
        'name' => 'string',
        'district' => 'string',
        'recommender_agent' => 'string',
        'recommender_member' => 'string',
        'date' => 'date',
        'gender' => 'string',
        'recommendees' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'district' => 'required',
        'recommender_agent' => 'required',
        'recommender_member' => 'required',
        'date' => 'required',
        'gender' => 'required',
        'agent' => 'required'
    ];
    public function agent(){
        $this->belongsTo('App/Models/Agent');
    }


}
