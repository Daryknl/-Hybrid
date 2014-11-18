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

class Configuration
{
    protected static $pData = array();
    
    public static function cache($configFile)
    {
        self::$pData[ $configFile ] = require_once(dirname(__FILE__) . '/../config/' . $configFile . '.php');
    }

    public static function get($config)
    {
        $file = sprintf('%/../config/%s.php', dirname(__FILE__), $config);
        
        if(isset(self::$pData[$config]))
        {
            return self::$pData[$config];
        }
        return require_once( $file );
    }
    
    public static function store($config)
    {
        return NULL;
    }
    
    public static function create($file, $data)
    {
        return NULL;
    }
}
