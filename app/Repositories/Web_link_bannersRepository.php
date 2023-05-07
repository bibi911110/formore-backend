<?php

namespace App\Repositories;

use App\Models\Web_link_banners;
use App\Repositories\BaseRepository;

/**
 * Class Web_link_bannersRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:49 am IST
*/

class Web_link_bannersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'link',
        'web_image'
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
        return Web_link_banners::class;
    }
}
