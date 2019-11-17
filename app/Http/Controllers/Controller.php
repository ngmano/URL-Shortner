<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $status = 200;
    public $message;
    public $data;
    public $url;

    public function __construct()
    {
    	
    }

    public function setMessage($message)
    {
    	$this->message = $message;
    	return $this;
    }

    public function setStatus($status)
    {
    	$this->status = $status;
    	return $this;
    }

    public function setData($data)
    {
    	$this->data = $data;
    	return $this;
    }

    public function setUrl($url)
    {
    	$this->url = $url;
    	return $this;
    }


    public function sendResponse($data = null)   
    {
    	if($data !== null) {
    		$this->setData($data);
    	}
    	return response()->json([
    		'status' => $this->status,
    		'message' => $this->message,
    		'redirect_url' => $this->url,
    		'data' => $this->data,
    	]);
    }
}
