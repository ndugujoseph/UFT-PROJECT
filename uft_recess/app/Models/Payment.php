<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @version June 27, 2019, 10:32 am UTC
 *
 * @property string Role
 * @property float amount
 */
class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Role',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'Role' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Role' => 'required'
    ];

    public function agent(){
        return $this->belongsTo('App/Models/Agent');
    }
    public function administrator(){
        return $this->belongsTo('App/Models/Administrator');
    }
}
