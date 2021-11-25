<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InstagramPostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class InstagramPostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\InstagramPost::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/instagram-post');
        CRUD::setEntityNameStrings('instagram post', 'instagram posts');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'preview_image',
                'type' => 'image',
                'label' => 'Imagen',
            ],
            [
                'name' => 'post_text',
                'type' => 'text',
                'label' => 'Descripcion',
            ],
            [
                'name' => 'post_video',
                'type' => 'text',
                'label' => 'Video Url',
            ],
            [
                'name' => 'post_id',
                'type' => 'text',
                'label' => 'Post ID',
            ],
            [
                'name' => 'is_video',
                'type' => 'text',
                'label' => 'Es video',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(InstagramPostRequest::class);

        CRUD::field('id');
        CRUD::field('post_id');
        CRUD::field('preview_image');
        CRUD::field('post_text');
        CRUD::field('post_video');
        CRUD::field('is_video');
        CRUD::field('created_at');
        CRUD::field('updated_at');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
