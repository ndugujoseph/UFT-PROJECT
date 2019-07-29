<?php

namespace App\Repositories;

use App\Models\Treasury;
use App\Repositories\BaseRepository;

/**
 * Class TreasuryRepository
 * @package App\Repositories
 * @version June 27, 2019, 10:29 am UTC
*/

class TreasuryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'well-wisher',
        'received-on'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Treasury::class;
    }
}
