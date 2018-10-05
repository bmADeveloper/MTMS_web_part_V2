<?php

/**
 * 
 */
class ApiResponse
{
	public $status;

	function __construct($message)
	{
		$this->status = $message;
	}

	function getResponse(){
		return $this->status;
	}
}