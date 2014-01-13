<?php

class LeagueAPIWrapper Extends HttpService
{
	const API_URL_1_1 = 'http://prod.api.pvp.net/api/lol/{region}/v1.1/';
	const API_URL_1_2 = 'http://prod.api.pvp.net/api/lol/{region}/v1.2/';
	const API_URL_1_3 = 'http://prod.api.pvp.net/api/lol/{region}/v1.3/';
	const API_URL_2_2 = 'http://prod.api.pvp.net/api/lol/{region}/v2.2/';
	const API_KEY = 'ae41c074-340c-4c93-8a1a-12300ffd135c';

	const API_URL_MASHAPE = 'https://community-league-of-legends.p.mashape.com/api/v1.0/{region}/summoner/';
	const API_KEY_MASHAPE = '90gwEFjQKj5EBjV4kt8mCKhCSKcg7A0s';

	private $region;

	public function __construct($region)
	{
		$this->region = $region;
	}

	public function getChampion()
	{
		return $this->request(self::API_URL_1_1 . 'champion');
	}

	public function getGame($id)
	{
		return $this->request(self::API_URL_1_3 . 'game/by-summoner/' . $id . '/recent');
	}

	public function getLeague($id)
	{
		return $this->request(self::API_URL_2_2 . 'league/by-summoner/' . $id);
	}

	public function getStats($id,$option='summary') // or ranked
	{
		return $this->request(self::API_URL_1_2 . 'stats/by-summoner/' . $id . '/' . $option);
	}

	public function getSummoner($id,$option=null)
	{
		$call = 'summoner/';
		switch ($option)
		{
			case 'masteries':
				$call .= $id. '/masteries';
				break;
				
			case 'runes':
				$call .= $id. '/runes';
				break;

			case 'name':
				$call .= $id. '/name';
				break;

			case 'by-name':
				$call .= 'by-name/' . $id;
				break;

			default:
				$call .= $id;
				break;
		}

		return $this->request(self::API_URL_1_2 . $call);
	}

	public function getTeam($id)
	{
		return $this->request(self::API_URL_2_1 . 'team/by-summoner/' . $id);
	}

	public function getSpectatorGameInfo($id)
	{
		return $this->get(str_replace('{region}', $this->region, self::API_URL_MASHAPE . 'retrieveInProgressSpectatorGameInfo/' . $id), self::API_KEY_MASHAPE);
	}

	private function request($call)
	{
		return $this->get(str_replace('{region}', $this->region, $call) . '?api_key=' . self::API_KEY); 
	}
}
?>