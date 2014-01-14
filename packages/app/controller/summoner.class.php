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
			$spectator = $LeagueAPIWrapper->getSpectatorGameInfo($this->data['param'][0]);
			var_dump($spectator);
		}

		$this->renderFile("index");
	}
}
?>