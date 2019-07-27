<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UftChart
 *
 * @package App
 * @property string $reports
*/
class UftChart extends Model
{
    use SoftDeletes;

    protected $fillable = ['reports'];
    protected $hidden = [];
    
    
    
}
