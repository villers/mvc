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
		$LeagueAPIWrapper = new LeagueAPIWrapper($server);
		$summoner = $LeagueAPIWrapper->getSummoner(19116763, 'masteries');
		var_dump($summoner);

		$this->renderFile("index");
	}
}
?>