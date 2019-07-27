<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Agent
 * @package App\Models
 * @version June 27, 2019, 10:13 am UTC
 *
 * @property string name
 * @property string district

 * @property string signature
 */
class Agent extends Model
{
    use SoftDeletes;

    public $table = 'agents';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'username',
        'date_of_birth',
        'email',
        'gender',
        'role',
        'signature',
        'district',
        'password'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'date_of_birth' => 'date',
        'email' => 'string',
        'gender' => 'string',
        'role' => 'string',
        'signature' => 'string',
        'district' => 'string',
        'password' => 'string'
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'signature' => 'required',
        'username' => 'required',
        'date_of_birth' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'password' => 'required'
    ];

    public function district(){
        return $this->belongsTo('App/Models/District');
    }
    public function member(){
        return $this->hasMany('App/Modes/Member');

    }
    public function payment(){
        return $this -> hasMany('App/Model/Payment');
    }
    public function Administrator(){
        return $this->belongsTo('App/Model/Administrator');
    }


}
