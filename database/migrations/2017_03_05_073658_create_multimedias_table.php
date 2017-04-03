<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultimediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->string('mime_type')->default('image/jpeg');
            $table->string('dimensions')->nullable();
            $table->longText('description')->nullable();
            $table->longText('alt_text')->nullable();
            $table->string('path');
            $table->integer('uploaded_by')->nullable();
            $table->timestamps();

            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multimedias', function(Blueprint $table){
            $table->dropForeign(['uploaded_by']);
        });
        Schema::dropIfExists('multimedias');
    }
}
