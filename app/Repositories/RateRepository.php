<?php

namespace App\Repositories;

use App\Models\Rate;
use App\Repositories\BaseRepository;

/**
 * Class RateRepository
 * @package App\Repositories
 * @version November 26, 2021, 3:48 am UTC
*/

class RateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'origin',
        'destination',
        'currency',
        'twenty',
        'forty',
        'fortyhc',
        'contract_id'
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
        return Rate::class;
    }
}
