<?php

class ErrorController extends Controller
{
	public function code_404()
	{
		header("HTTP/1.1 404 Not found");
		$this->render();
	}
}
?>