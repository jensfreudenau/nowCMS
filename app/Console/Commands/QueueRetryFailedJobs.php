<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class QueueRetryFailedJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:queue-retry-failed-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release all failed-jobs onto the queue';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $failed = $this->laravel['queue.failer']->all();
        $idArray = array();
        if (!empty($failed)) {
            for ($i = 0; $i < sizeof($failed); $i++) {
                $idArray[] = $failed[$i]->id;
            }
            $this->call('queue:retry', ['id' => $idArray]);
        } else {
            $this->error('No failed jobs.');
        }
    }
}
