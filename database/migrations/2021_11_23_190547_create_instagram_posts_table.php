<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_posts', function (Blueprint $table) {
            $table->id();
            $table->text('post_id')->nullable(true);
            $table->text('preview_image')->nullable(true);
            $table->text('post_text')->nullable(true);
            $table->text('post_video')->nullable(true);
            $table->boolean('is_video')->nullable(true)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_posts');
    }
}
