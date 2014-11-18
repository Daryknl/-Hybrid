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

namespace application;

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

class bootstrap
{
    protected static $registry = null;
    
    public static function initialize()
    {
        ini_set('session.hash_function', 'whirlpool');
        if(!session_id())
        {
            session_start();
        }
        
        self::initAutoloader();
        
        $registry = Library\Registery::getInstance();
        
        # Project Properties Please Don't Remove
        $registry->author   = 'GarettisHere';
        $registry->powered  = 'HybridCMS';
        $registry->version  = '1.0.0';
        $registry->license  = 'Attribution-NonCommercial 4.0 International';
        
        self::$registry = $registry;
    }
    
    private static function initAutoloader()
    {
        require_once(dirname(__FILE__) . '/library/autoloader.php');
        library\autoloader::register();
    }
    private static function initConfiguration()
    {
        return NULL;
    }
    private static function initDatabase()
    {
        return NULL;
    }
}
