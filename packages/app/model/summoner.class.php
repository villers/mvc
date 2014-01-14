<?php 

class SuumonerModel
{
	public static function ActiveGame($server, $pseudo)
	{
			$LeagueAPIWrapper = new LeagueAPIWrapper($server);
			//$spectator = substr($LeagueAPIWrapper->getSpectatorGameInfo($pseudo), 1, -1);
			//var_dump(json_decode($spectator));
			/*if($spectator['success'] == false)
				return $spectator;

			$team1 = $spectator->game->TeamOne->array;
			print_r($team1);*/







			return $spectator;
	}
}
?>