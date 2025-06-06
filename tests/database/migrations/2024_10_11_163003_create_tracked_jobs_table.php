<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracked_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('trackable_id')->index('tracked_jobs_trackable_id_index');
            $table->string('trackable_type')->index('tracked_jobs_trackable_type_index');
            $table->string('name');
            $table->string('status')->default('queued');
            $table->longText('output')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('tracked_jobs');
    }
}
