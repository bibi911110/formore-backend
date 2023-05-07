<?php

namespace App\Repositories;

use App\Models\Offer_banner;
use App\Repositories\BaseRepository;

/**
 * Class Offer_bannerRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:51 am IST
*/

class Offer_bannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offer_image'
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
        return Offer_banner::class;
    }
}
