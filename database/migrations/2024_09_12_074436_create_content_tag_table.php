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
        Schema::create('content_tag', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->unsignedInteger('content_id')->index('content_tag_ibfk_1');
            $table->unsignedInteger('tag_id')->index('content_tag_ibfk_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_tag');
    }
};
