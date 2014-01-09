<?php

class Router
{
    public static $router = null, $param = array(), $baseUrl;

    public static function run()
    {
        if (self::$router == null && count(self::$param) == 0)  
        {
            /* Get base Url */ 
            $url_list = explode('/', $_SERVER['SCRIPT_NAME']);
            array_pop($url_list);
            self::$baseUrl = rtrim(implode('/', $url_list), "/");

            if (isset($_SERVER["PATH_INFO"]))
            {
                $result = explode("/", substr(strtolower($_SERVER["PATH_INFO"]), 1));
                /* Delete empty result */
                for ($i = 0; $i < count($result) && $i < MAX_PARAMETERS+2;)
                    if (empty($result[$i]))
                    {
                        unset($result[$i]);
                        $result = array_values($result);
                    }else
                        $i++;

                if (!isset($result[0]))
                    $result[0] = DEFAULT_CONTROLLER;
                else
                    if (!file_exists(PATH_CONTROLLER.$result[0] .".class.php"))
                    {
                        $result[0] = "error";
                        $result[1] = "code_404";
                    }
            }

            /* Add Controller and Action in Router Array */
            self::$router = array(
                "controller"    => isset($result[0]) ? $result[0] : DEFAULT_CONTROLLER,
                "action"        => isset($result[1]) ? $result[1] : DEFAULT_ACTION,
            );

            /* Add Params to Router Array */
            if (isset($result) && count($result) > 2)
                for ($i = 2; $i < count($result) && $i-2 < MAX_PARAMETERS; $i++)
                    if (!empty($result[$i]))
                        array_push(self::$param, $result[$i]);
        }
    }
}
?>