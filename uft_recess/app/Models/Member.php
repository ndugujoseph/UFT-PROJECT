<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 * @package App\Models
 * @version June 27, 2019, 10:32 am UTC
 *
 * @property string id
 * @property string name
 * @property string district
 * @property string recommender
 * @property string DateOfEnroll
 * @property string gender
 * @property string agent
 */
class Member extends Model
{
    use SoftDeletes;

    public $table = 'members';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'name',
        'district',
        'recommender',
        'DateOfEnroll',
        'gender',
        'agent'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'district' => 'string',
        'recommender' => 'string',
        'DateOfEnroll' => 'date',
        'gender' => 'string',
        'agent' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'district' => 'required',
        'recommender' => 'required',
        'DateOfEnroll' => 'required',
        'gender' => 'required',
        'agent' => 'required'
    ];
    public function agent(){
        $this->belongsTo('App/Models/Agent');
    }


}
