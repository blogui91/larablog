<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('slug');
            $table->string('image');
            $table->boolean('published')->default(0);
            $table->string('published_at')->default(Carbon::now());
            $table->integer('published_by')->unsigned();
            $table->integer('updated_by')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('published_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign(['published_by','updated_by']);
        });

        Schema::dropIfExists('posts');
    }
}
