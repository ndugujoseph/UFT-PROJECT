<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Hash;

/**
 * Class Agents
 *
 * @package App
 * @property string $full_name
 * @property string $username
 * @property string $date_of_birth
 * @property string $email
 * @property string $gender
 * @property string $role
 * @property string $district
 * @property string $signature
 * @property string $password
*/
class Agents extends Model
{
    protected $fillable = ['full_name', 'username', 'date_of_birth', 'email', 'gender', 'signature', 'password', 'role_id', 'district_id'];
    protected $hidden = ['password'];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateOfBirthAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_of_birth'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateOfBirthAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDistrictIdAttribute($input)
    {
        $this->attributes['district_id'] = $input ? $input : null;
    }/**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id')->withTrashed();
    }
    
}
