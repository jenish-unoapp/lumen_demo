<?php

namespace App\Jobs;

class ExampleJob extends Job
{
    private $data;

    /**
     * Create a new job instance.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::addInfo("Jobs Data Dump", array("data" => $this->data, "time" => date("Y-m-d H:i:s")));
    }
}
