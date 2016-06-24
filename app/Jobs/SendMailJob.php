<?php

namespace App\Jobs;

use App\Events\SendMailEvent;

class SendMailJob extends Job
{
    /**
     * @var array $to
     */
    private $to;

    /**
     * @var string $subject
     */
    private $subject;

    /**
     * @var bool $is_raw
     */
    private $is_raw;

    /**
     * @var string $view_name
     */
    private $view_name;

    /**
     * @var array $view_data
     */
    private $view_data;

    /**
     * @var string $raw_message
     */
    private $raw_message;

    /**
     * Create a Send mail job instance.
     * @param array $to
     * @param string $subject
     * @param bool $is_raw
     * @param string $view_name
     * @param array|null $view_data
     * @param string $raw_message
     */
    public function __construct($to, $subject, $is_raw, $view_name, $view_data, $raw_message)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->is_raw = $is_raw;
        $this->view_name = $view_name;
        $this->view_data = $view_data;
        $this->raw_message = $raw_message;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts() > 3) {
            $this->release(10);
        }

        event(new SendMailEvent(
            $this->to,
            $this->subject,
            $this->is_raw,
            $this->view_name,
            $this->view_data,
            $this->raw_message
        ));
    }
}
