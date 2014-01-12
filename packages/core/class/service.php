<?php

class Service
{
	public function get($url)
	{
		switch(Unirest::get($url)->code)
		{
			case 200:
				return Unirest::get($url)->body;
				break;

			default:
			case 404: // Page Not Found
			case 400: // Bad Request
			case 401: // Bad URL
			case 500: // Internal Server Error
				return array("error" => Unirest::get($url)->code);
				break;
		}
	}
}
?>