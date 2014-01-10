<?php 

class Controller
{
	protected $data = array(), $twig;

	public function __construct($router, $param, $baseUrl)
	{
		/* Main Data */
		$this->data_push(
			array(
				"router"	=> $router,
				"param"		=> $param,
				"data"		=> Application::$data
			)
		);

		/* getInstance PDO */
		$PDO = PDO2::getInstance();

		/* Transfer data sql to array */
		$PDO->query("SELECT `key`, `value` FROM `data`")->fetchAll(PDO::FETCH_FUNC, array($this, "data_push"));
		$this->data_push("assets", "{$baseUrl}/public/{$this->data["default_template"]}/assets/");
		$this->data_push("baseurl", "{$baseUrl}/");

		/* Get Twig Environement */
		$this->twig = $this->getTwigEnvironement();
	}

	public function render()
	{
		echo $this->twig->render("{$this->data["router"]["controller"]}/{$this->data["router"]["action"]}.twig", $this->data);
	}

	private function getTwigEnvironement()
	{
		Twig_Autoloader::register();

		return new Twig_Environment(new Twig_Loader_Filesystem(PATH_PUBLIC . "{$this->data["default_template"]}/view"),
			array(
				'cache' => Application::$config["CACHE_TWIG"] ? PATH_TMP ."twig" : Application::$config["CACHE_TWIG"]
			)
		);
	}

	public function data_push($key, $value=null)
	{
		if (is_array($key) && $value == null)
			foreach ($key as $new_key => $value)
				$this->data[$new_key] = $value;
		else
			$this->data[$key] = $value;
	}

	public static function loadNewController($class, $method)
	{
		$router = array(
			"controller" 	=> $class,
			"action" 		=> $method,
		);

		$selectedController = new ReflectionClass($class);
		call_user_func_array(array($selectedController->newInstanceArgs(array($router, array(), Router::$baseUrl)), $router["action"]), array());
	}
}
?>