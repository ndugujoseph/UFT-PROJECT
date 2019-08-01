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
 * @property string $email
 * @property string $gender
 * @property string $role
 * @property string $district
 * @property string $signature
 * @property string $password
*/
class Agents extends Model
{
    protected $fillable = ['full_name', 'username', 'email', 'gender', 'signature', 'password', 'role_id', 'district_id'];
    protected $hidden = ['password'];
    
    

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
