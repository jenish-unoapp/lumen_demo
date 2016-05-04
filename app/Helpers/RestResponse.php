<?php


class RestResponse
{
    public $code;
    public $status;
    public $message;
    public $payload;
    public $session;

    public function __construct($status, $message, $payload)
    {
        $authToken = App::make('authToken');
        $this->status = $status;
        $this->session = isset($authToken->Id) ? $authToken->toArray() : null;
        if (isset($this->session['UserId'])) unset($this->session['UserId']);
        switch ($status) {
            case 'ok':
                $this->code = 200;
                if ($message == "") {
                    $message = "OK";
                }
                break;
            case 'redirect':
                $this->code = 302;
                if ($message == "") {
                    $message = "Redirect";
                }
                break;
            case 'notmodified':
                $this->code = 304;
                break;
            case 'badrequest':
                $this->code = 400;
                if ($message == "") {
                    $message = "Bad Request";
                }
                break;
            case 'unauthorized':
                $this->code = 401;
                if ($message == "") {
                    $message = "Unauthorized";
                }
                break;
            case 'forbidden':
                $this->code = 403;
                if ($message == "") {
                    $message = "Forbidden";
                }
                break;
            case 'notfound':
                $this->code = 404;
                break;
            case 'error':
                $this->code = 500;
                break;
            default:
                throw new Exception('RestResponse Exception: Status not supported.');
                break;
        }
        $this->message = $message;
        $this->payload = $payload;
    }

    public function toJSON()
    {
        $resp = response(json_encode($this), $this->code, array('charset' => 'utf-8', 'Content-type' => 'application/json'));
        return $resp;
    }
}
