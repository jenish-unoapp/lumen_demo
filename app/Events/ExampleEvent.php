<?php

namespace App\Events;

class ExampleEvent extends Event
{
    private $data;

    /**
     * Create a new event instance.
     *
     * @param $d
     */
    public function __construct($d)
    {
        $this->data = $d;
        //
    }
}
