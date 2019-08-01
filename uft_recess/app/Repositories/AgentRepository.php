<?php

namespace App\Repositories;

use App\Models\Agent;
use App\Repositories\BaseRepository;

/**
 * Class AgentRepository
 * @package App\Repositories
 * @version June 27, 2019, 10:13 am UTC
*/

class AgentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'username',
        'date_of_birth',
        'email',
        'gender',
        'district',
        'signature'
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
        return Agent::class;
    }
}
