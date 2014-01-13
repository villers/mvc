<?php

class Application
{
	public static $config, $data;

	public static function run()
	{
		require_once(PATH_CLASS .'autoloader.class.php');
		$loader = Autoloader::getInstance()
			->addDirectory(PATH_CLASS)
			->addDirectory(PATH_CONTROLLER)
			->addDirectory(PATH_MODEL)
			->addEntireDirectory(PATH_VENDOR);

		/* Load router*/
		Router::run();

		/* Load default language */
		Translation::initialize(DEFAULT_LANGUAGE);

		/* Import des config et des données statiques */
		self::$config 	= require_once(PATH_APP."config.php");
		self::$data 	= require_once(PATH_APP."data.php");

		try
		{
			// Récupère le nom de la classe du Controller
			$className = ucfirst(strtolower(Router::$router["controller"]))."Controller";

			// Permet de vérifier que la class existe puis initialise l'instentie
			$controller = new ReflectionClass($className);
			$call_controller = $controller->newInstanceArgs(array(Router::$router, Router::$param, Router::$baseUrl));

			// Permet de vérifier que la method existe et qu'elle ne provient pas du controller principal
			$refl = new ReflectionMethod($call_controller, Router::$router["action"]);
			if(($refl->class == "Controller") || (!$refl->isPublic()))
				throw new Exception();

			// Appel la méthod de la class récupéré par le routeur.
			call_user_func_array(array($call_controller, Router::$router["action"]), array());
		}
		catch (Exception $e)
		{
			print $e->getmessage();
			Controller::loadNewController("Error", "code_404");
		}

	}
}
?>