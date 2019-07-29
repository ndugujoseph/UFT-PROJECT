<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Districts
 *
 * @package App
 * @property string $name
 * @property string $initials
 * @property string $region
 * @property string $agent_head
 * @property integer $agents
 * @property integer $members
*/
class Districts extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'initials', 'region', 'agent_head', 'agents', 'members'];
    protected $hidden = [];
    
    
    
    public function well_wishers() {
        return $this->hasMany(WellWishers::class, 'district_id');
    }
    public function agents() {
        return $this->hasMany(Agents::class, 'district_id');
    }
}
