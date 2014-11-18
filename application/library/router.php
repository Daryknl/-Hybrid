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
    global $config;
    
    if(isset($config, $config['domain']))
    {
        $location = sprintf('Location: http://%s/404', $config['domain']);
        header($location);
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

class router
{
    public static function get($request, $callback)
    {
        $match = self::match($request, 'GET');
    }
    public static function post($request, $callback)
    {
        $match = self::match($request, 'POST');
    }
    public static function all($request, $callback)
    {
        $match = self::match($request, '*');
        
        if($match != NULL)
        {
            if(is_callable($callback))
            {
                $options = null;
                return $callback($options);
            } else {
                // TODO: format to class call
                // 'className@foo' : className->foo($options);
            }
        }
    }
    public static function match($request, $method)
    {
        if(stripos('[', $request) && stripos(']', $request))
        {
            
        }
        
        if($_SERVER['REQUEST_METHOD'] == $method || $method == '*')
        {
            
        }
        
        return NULL;
    }
}
class routerMatchObject
{
    protected $request;
    protected $options;
    protected $match;
    
    public function __construct($request, $options)
    {
        $this->request = $request;
        $this->options = $options;
    }
    
    public function getOption()
    {
        return $this->options;
    }
}
