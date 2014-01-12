<?php

class Summoner extends Controller
{
	public function index()
	{
		$this->render();
	}

	public function na()
	{
		// teste
		$image = new StaticDataService();
		echo $image->getStaticImage("champion", "Shaco");
		$this->loadServer(__FUNCTION__);
	}

	public function euw()
	{
		$this->loadServer(__FUNCTION__);
	}

	public function eune()
	{
		$this->loadServer(__FUNCTION__);
	}

	private function loadServer($server)
	{
		$this->renderFile("index");
	}
}
?>