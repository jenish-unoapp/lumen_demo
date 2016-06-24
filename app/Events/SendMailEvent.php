<?php

namespace App\Events;

class SendMailEvent extends Event
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
     * Create a new Send mail event instance.
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
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return boolean
     */
    public function isRaw()
    {
        return $this->is_raw;
    }

    /**
     * @param boolean $is_raw
     */
    public function setIsRaw($is_raw)
    {
        $this->is_raw = $is_raw;
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->view_name;
    }

    /**
     * @param string $view_name
     */
    public function setViewName($view_name)
    {
        $this->view_name = $view_name;
    }

    /**
     * @return array
     */
    public function getViewData()
    {
        return $this->view_data;
    }

    /**
     * @param array $view_data
     */
    public function setViewData($view_data)
    {
        $this->view_data = $view_data;
    }

    /**
     * @return string
     */
    public function getRawMessage()
    {
        return $this->raw_message;
    }

    /**
     * @param string $raw_message
     */
    public function setRawMessage($raw_message)
    {
        $this->raw_message = $raw_message;
    }
}
