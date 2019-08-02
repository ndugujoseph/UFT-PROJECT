<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WellWishers
 * @package App\Models
 * @version June 27, 2019, 10:29 am UTC
 *
 * @property string name
 * @property float amount
 * @property string date
 * @property integer district_id
 */
class WellWishers extends Model
{
    use SoftDeletes;

    public $table = 'well_wishers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    


    public $fillable = [
        'name',
        'amount',
        'date',
        'district_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'total' => 'float',
        'date' => 'date',
        'district_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'amount' => 'required',
        'date' => 'required',
        'district_id' => 'required'
    ];

    
}
