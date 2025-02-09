<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_tag', function (Blueprint $table) {
            $table->unsignedInteger('content_id');
            $table->unsignedInteger('tag_id');
            
            $table->foreign('content_id', 'content_tag_ibfk_1')->references('id')->on('contents');
            $table->foreign('tag_id', 'content_tag_ibfk_2')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_tag');
    }
}
