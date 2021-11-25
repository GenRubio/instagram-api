<?php

namespace App\Repositories\InstagramPost;

use App\Models\InstagramPost;
use App\Repositories\Repository;


/**
 * Class InstagramPostRepository
 * @package App\Repositories\InstagramPost
 */
class InstagramPostRepository extends Repository implements InstagramPostRepositoryInterface
{
    /**
     * @var instagramPost
     */
    protected $model;

    /**
     * InstagramPostRepository constructor.
     */
    public function __construct()
    {
        $this->model = new InstagramPost();
        parent::__construct($this->model);
    }
}
