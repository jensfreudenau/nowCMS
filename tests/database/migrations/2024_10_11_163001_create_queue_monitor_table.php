<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueMonitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_monitor', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('job_uuid')->nullable();
            $table->string('job_id')->index('queue_monitor_job_id_index');
            $table->string('name')->nullable();
            $table->string('queue')->nullable();
            $table->unsignedInteger('status')->default(0);
            $table->dateTime('queued_at')->nullable();
            $table->timestamp('started_at')->nullable()->index('queue_monitor_started_at_index');
            $table->string('started_at_exact')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->string('finished_at_exact')->nullable();
            $table->integer('attempt')->default(0);
            $table->boolean('retried')->default(0);
            $table->integer('progress')->nullable();
            $table->longText('exception')->nullable();
            $table->text('exception_message')->nullable();
            $table->text('exception_class')->nullable();
            $table->longText('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_monitor');
    }
}
