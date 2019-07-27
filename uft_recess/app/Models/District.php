<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class District
 * @package App\Models
 * @version June 27, 2019, 10:31 am UTC
 *
 * @property string code
 * @property string name
 * @property integer enrollments
 */
class District extends Model
{
    use SoftDeletes;

    public $table = 'districts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'initials',
        'region',
        'agent_head',
        'agents',
        'members'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
        'name' => 'string',
        'initials' => 'string',
        'region' => 'string',
        'agent_head' => 'string',
        'agents' => 'integer',
        'members' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'initials' => 'required',
        'region' => 'required'
    ];

    public function agent(){
        return $this->hasMany('App/Models/Agent');
    }
    public function member(){
        return $this->hasMany('App/Models/Member');
    }


}
