<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\InstagramPost;
use Exception;

/**
 * Class InstagramPostService
 * @package App\Services\InstagramPost
 */
class InstagramPostService extends Controller
{
    /**
     * InstagramPostService constructor.
     * @param InstagramPost $instagrampost
     */
    public function __construct()
    {

    }

    public function importPosts()
    {
        $media = (new InstagramUserService())->getMedia();

        foreach ($media as $post) {
            if (is_null($this->existPost($this->getPostId($post)))){
               $this->insertPost($this->prepareDataPost($post));
            }
        }
    }

    public function insertPost($data){
        InstagramPost::create($data);
    }

    public function prepareDataPost($post){
        return [
            "post_id" => $this->getPostId($post),
            "preview_image" => $this->getPreviewImage($post),
            "post_text" => $this->getDescription($post),
            "post_video" => $this->getVideo($post)
        ];
    }

    public function existPost($postId){
        return InstagramPost::where('post_id', $postId)->first();
    }

    public function getPostId($post)
    {
        return $post->node->id;
    }

    public function getDescription($post)
    {
        try {
            $descriptions = $post->node->edge_media_to_caption->edges;
            foreach ($descriptions as $description) {
                return $description->node->text;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getPreviewImage($post)
    {
        try {
            return $post->node->display_url;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getVideo($post)
    {
        try {
            if ($post->node->is_video) {
                return $post->node->video_url;
            }
        } catch (Exception $e) {
            return null;
        }
    }
}
