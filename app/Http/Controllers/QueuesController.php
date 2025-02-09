<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobFail;


class QueuesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list()
    {
        $jobsFailed = new JobFail();
        debug($jobsFailed->toArray());
        $jobs = new Job();
        dump($jobs);

//        foreach ($jobs as $job) {
//            debug($job->id);
//        }

        return view('admin.queues.list');
    }
}
