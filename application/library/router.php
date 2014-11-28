<?php
/**
 *	&HybridCMS
 *	CMS (Content Management System) for Habbo Emulators.
 *
 *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
 *	@version    1.0.0
 *	@link       http://github.com/GarettMcCarty/HybridCMS
 *	@license    Attribution-NonCommercial 4.0 International
 */

namespace application\library;

if(!defined('HybridSecure'))
{
    if(class_exists('Configuration', true) !== false)
    {
        try {
            $application = Configuration::get('app');
            if(isset($application['url']))
            {
                $location = sprintf('Location: %s/404', $application['url']);
                header($location);
                unset($application);
            }
        } catch(\Exception $ex) {}
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

/**
 * URL Router
 */
class Router
{
    protected static $regex  = ['[string]' => '([^/]+)', '[int]' => '(\d+)', '[*]' => '(.*?)'];
    protected static $routes = [];

    // GET Helper
    public static function GET($uri, $callback)
    {
            return self::addRoute('GET', $uri, $callback);
    }
    // POST Helper
    public static function POST($uri, $callback)
    {
            return self::addRoute('POST', $uri, $callback);
    }

    public static function addRoute($method, $uri, $callback)
    {
        $uri = str_ireplace(array_keys(self::$regex), array_values(self::$regex), $uri);
        self::$routes[$uri] = sprintf('~^/index.php%s$~', $uri);

        $request = filter_input(INPUT_SERVER, 'REQUEST_URI');

        if(strpos($request, 'index.php') == false)
        {
            $request  = sprintf('/index.php%s', $request);
        }

        if($method != filter_input(INPUT_SERVER, 'REQUEST_METHOD'))
        {
            return;
        }

        if(array_key_exists($uri, self::$routes))
        {
            if(preg_match(self::$routes[$uri], $request, $matches) !== false)
            {
                if(count($matches) > 0 && $matches[0] == $request)
                {
                    if(is_callable($callback))
                    {
                        if(isset($matches[1]))
                        {
                            echo $callback($matches[1]);
                        } else {
                            echo $callback();
                        }
                    } else {
                        if(stripos($callback, '@'))
                        {
                            $data = explode('@', $callback);
                            $controller = "\application\controller\{$data[0]}";

                            if(isset($matches[1]))
                            {
                                $matches = array_shift($matches);
                                call_user_func_array(array(new $controller, $data[1]), $matches);
                            } else {
                                call_user_func(array(new $controller, $data[1]));
                            }
                        } else {
                            throw new \InvalidArgumentException('Routes must use a controller or a callable function.');
                        }
                    }
                }
            }

        }
    }
    
    public static function redirectTO($location)
    {
        $direction = '';
        if(strpos($location, 'http://') !== false || strpos($location, 'https://') !== false)
        {
            $direction = sprintf('Location: %s', $location);
        }
        header($direction);
        return;
    }
}