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
        'code',
        'name',
        'enrollments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'enrollments'=> 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'name' => 'required'
    ];

    public function agent(){
        return $this->hasMany('App/Models/Agent');
    }
    public function member(){
        return $this->hasMany('App/Models/Member');
    }


}
