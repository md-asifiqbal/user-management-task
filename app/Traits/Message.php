<?php

namespace App\Traits;

trait Message
{
    protected $status = false;

    protected $message = '';

    protected $reset = false;

    protected $modal = false;

    protected $table = false;

    protected $button = false;

    protected $url = false;

    protected $api_token = '';

    protected $html_page = false;

    protected $login = false;

    protected $data = [];

    /**
     * Return Default Output Message
     * This Method for web JSON Response
     */
    protected function output($message = null)
    {
        return [
            'status' => $this->status, 'message' => is_null($message) ? $this->message : $message, 'reset' => $this->reset,
            'table' => $this->table, 'modal' => $this->modal, 'button' => $this->button, 'url' => $this->url, 'html_page' => $this->html_page,
        ];
    }

    /**
     *  Success  Function Set the Value as Success
     * This Method for Web Success Message
     */
    protected function success($msg = null, $reset = true, $modal = true, $table = true, $button = false)
    {
        $this->status = true;
        $this->message = $msg == null ? !empty($this->message) ? $this->message : 'Information Save Successfully' : $msg;
        $this->reset = $reset;
        $this->modal = $modal;
        $this->table = $table;
        $this->button = $button;
    }

    /**
     *  Error  Function Set the Value as Error
     * This Method for Web Error Message
     */
    protected function error($msg = null, $reset = false, $modal = false, $table = false, $button = false)
    {
        $this->status = false;
        $this->message = $msg == null ? !empty($this->message) ? $this->message : 'Something went wrong!' : $msg;
        $this->reset = $reset;
        $this->modal = $modal;
        $this->table = $table;
        $this->button = $button;
    }

   
    /**
     * Get Error Message
     * If Application Environtment is local then
     * Return Error Message With filename and Line Number
     * else return a Simple Error Message
     */
    protected function getError($e = null, $code = 500)
    {
        if (strtolower(env('APP_ENV')) == 'local' && !empty($e)) {
            $error = $e->getMessage() . ' On File ' . $e->getFile() . ' on line ' . $e->getLine();

            return $this->apiOutput($error, $code);
        }

        return $this->apiOutput('Something went wrong!', $code);
    }

    /**
     * Get Validation Error
     */
    public function getValidationError($validator)
    {
        if (strtolower(env('APP_ENV')) == 'local') {
            return $this->apiOutput($validator->errors()->first(), 422);
        }

        return $this->apiOutput('Data Validation Error!', 422);
    }
}
