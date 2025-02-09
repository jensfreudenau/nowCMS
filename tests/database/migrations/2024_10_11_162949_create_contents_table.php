<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('date', 12)->default('');
            $table->string('header', 250)->default('');
            $table->string('metadescription', 250)->nullable();
            $table->string('slug', 250)->default('');
            $table->longText('text')->nullable();
            $table->tinyInteger('album')->nullable();
            $table->smallInteger('active')->nullable();
            $table->smallInteger('single')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
