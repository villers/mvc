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
			$LeagueAPIWrapper = new LeagueAPIWrapper($server);
			$summoner = $LeagueAPIWrapper->getSpectatorGameInfo($this->data['param'][0]);
			var_dump($summoner);
		}

		$this->renderFile("index");
	}
}
?>