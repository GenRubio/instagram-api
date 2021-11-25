<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;

class BlueprintHelper extends Blueprint
{

    public function defaultOrder()
    {
        //CAMPOS ORDEN BACKPACK
        $this->integer('parent_id')->unsigned()->nullable();
        $this->integer('lft')->unsigned()->nullable();
        $this->integer('rgt')->unsigned()->nullable();
        $this->integer('depth')->unsigned()->nullable();
    }

    public function defaultActive($active = 0)
    {
        $this->boolean('active')->default($active);
    }

    public function defaultFeatured($featured = 0)
    {
        $this->boolean('featured')->default($featured);
        $this->integer('featured_order')->nullable();
    }

    public function defaultTimeStamps()
    {
        $this->integer('created_user')->nullable();
        $this->timestamp('created_at')->nullable();
        $this->integer('updated_user')->nullable();
        $this->timestamp('updated_at')->nullable();
        $this->integer('deleted_user')->nullable();
    }

}
