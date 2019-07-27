<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\BaseRepository;

/**
 * Class MemberRepository
 * @package App\Repositories
 * @version June 27, 2019, 10:32 am UTC
*/

class MemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'district',
        'recommender',
        'DateOfEnroll',
        'gender',
        'agent'
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
        return Member::class;
    }
}
