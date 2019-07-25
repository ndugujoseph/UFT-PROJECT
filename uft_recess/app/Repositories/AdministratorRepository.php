<?php

namespace App\Repositories;

use App\Models\Administrator;
use App\Repositories\BaseRepository;

/**
 * Class AdministratorRepository
 * @package App\Repositories
 * @version July 6, 2019, 10:00 am UTC
*/

class AdministratorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
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
        return Administrator::class;
    }
}
