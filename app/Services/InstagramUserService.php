<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Traits\InstagramDataTrait;

/**
 * Class InstagramUserService
 * @package App\Services\InstagramUser
 */
class InstagramUserService extends Controller
{
    use InstagramDataTrait;
    
    private $response;
    private $user;
    private static $disk;
    private static $fileTimeExpiration;
    private static $instagramUser;
    /**
     * InstagramPostService constructor.
     * @param InstagramPost $instagrampost
     */
    public function __construct()
    {
        self::$disk = 'instagram-imports';
        self::$instagramUser = 'gen_rubio';
        self::$fileTimeExpiration = 3600;//Time in second 
        $this->response = $this->getResponseApiData(self::$disk, self::$instagramUser, self::$fileTimeExpiration);
        $this->user = $this->response->graphql->user;
    }

    public function getMedia(){
        return $this->user->edge_owner_to_timeline_media->edges;
    }

    public function getFullName(){
        return $this->user->full_name;
    }

    public function getBiography(){
        return $this->user->biography;
    }

    public function getUserImage(){
        return $this->user->profile_pic_url_hd;
    }

    public function getUserName(){
        return $this->user->username;
    }

    public function getFollowers(){
        return $this->user->edge_followed_by->count;
    }
}
