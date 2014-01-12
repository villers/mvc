<?php

class StaticDataService2 Extends Service
{
	private $apiHost = 'http://ddragon.leagueoflegends.com';
	private $version = array();
	private $apiURLs = array (
		'champion',
		'item',
		'profileicon',
		'spell',
		'mastery',
		'rune'
	);

	function __construct()
	{
        $this->version = $this->get($this->apiHost . "/realms/na.json");
    }

	public function __call ($function, $args = NULL)
	{
		if (!in_array($function, $this->apiURLs))
			throw new Exception ("La fonction n'existe pas");

		if (empty($args))
			$args[0] = $this->version->n->$function;

		return $this->get($this->apiHost . "/cdn/{$args[0]}/data/en_US/{$function}.json");
	}

	public function getStaticImage ($type, $img)
	{
		if ((!in_array($type, $this->apiURLs)) &&  $type != 'sprite')
			throw new Exception ("La type n'existe pas");

		return $this->apiHost . "/cdn/{$this->version->n->$type}/img/$type/{$img}.png";
	}
}
/*
	$image = new StaticDataService();
	print_r($image->items("3.15.5"));
	print_r($image->items());
	print_r($image->getStaticImage("champions", "Shaco"));
*/
?>