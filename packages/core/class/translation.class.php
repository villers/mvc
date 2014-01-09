<?php 

class Translation
{
	public static $lang;

	public static function initialize($choiceLang = DEFAULT_LANGUAGE)
	{
		if (file_exists(PATH_APP . "lang/{$choiceLang}lang.php"))
			self::$lang = include_once(PATH_APP . "lang/{$choiceLang}lang.php");
	}
}
?>