<?php

class SummonerController extends Controller
{
	public function index()
	{
		$this->na();
	}

	public function na()
	{
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
		if(isset($this->data['param'][0]))
		{
			SuumonerModel::ActiveGame($server, $this->data['param'][0]);
			
		}

		$this->renderFile("index");
	}
}
?>