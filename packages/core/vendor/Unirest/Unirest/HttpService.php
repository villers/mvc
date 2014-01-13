<?php

class HttpService
{
	public function get($url, $key = null)
	{

		$response = (empty($key)) ? Unirest::get($url) : Unirest::get($url,array("X-Mashape-Authorization" => $key),null);

		switch($response->code)
		{
			case 200:
				return $response->body;
				break;

			default:
			case 404: // Page Not Found
			case 400: // Bad Request
			case 401: // Bad URL
			case 500: // Internal Server Error
				return array("error" => $response->code);
				break;
		}
	}
}
?>