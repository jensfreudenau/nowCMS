<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('category_id');
            $table->string('date', 12)->default('');
            $table->string('header', 250)->default('');
            $table->string('metadescription', 250)->nullable();
            $table->string('slug', 250)->default('');
            $table->longText('text');
            $table->boolean('album')->nullable();
            $table->smallInteger('active')->nullable();
            $table->smallInteger('single')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
