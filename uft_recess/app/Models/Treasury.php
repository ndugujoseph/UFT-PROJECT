<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Treasury
 * @package App\Models
 * @version June 27, 2019, 10:29 am UTC
 *
 * @property float amount
 * @property float total
 * @property string date
 */
class Treasury extends Model
{
    use SoftDeletes;

    public $table = 'tresuaries';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'amount',
        'total',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'float',
        'total' => 'float',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required',
        'date' => 'required',
        'date' => 'required'
    ];

    
}
