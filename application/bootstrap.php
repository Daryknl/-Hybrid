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
use application\library\Router as Router;

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
 * Hybrid Bootstrap
 */
class bootstrap
{
    protected static $registry = null;
    
    /**
     * Summary of initialize
     */
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
        
        # Initialize Database Connection
        if(file_exists( $config = sprintf('%s/storage/install.lock', dirname(__FILE__)) ))
        {
            # Initialize Database Connection
            self::initDatabase();
        } else {
            # TODO: Do Install.
            $host   = filter_input(INPUT_SERVER, 'HTTP_HOST');
            $uri    = filter_input(INPUT_SERVER, 'REQUEST_URI');
            $domain = sprintf('http://%s%s', $host, $uri);
            if(stripos($domain, '/index.php'))
            {
                $domain = sprintf('%s/../index.php/install', $domain);
            } else {
                $domain = sprintf('%s/index.php/install', $domain);
            }
            
            $controller = new controller\Install();
            
            # Relised this would just loop.
            #Router::redirectTO($domain);
        }
        
        # Require Hybrid Routes
        require( dirname(__FILE__) . '/routes.php' );
    }
    
    /**
     * Summary of initAutoloader
     */
    private static function initAutoloader()
    {
        require_once(dirname(__FILE__) . '/library/autoloader.php');
        library\autoloader::register();
    }
    /**
     * Summary of initConfiguration
     * @return mixed
     */
    private static function initConfiguration()
    {
        # TODO: Cache Configuration File(s)
        return NULL;
    }
    /**
     * Summary of initDatabase
     * @throws Exception 
     */
    private static function initDatabase()
    {
        $registry = self::$registry;
        $registry->database = new library\database\Adapter();
        
        if(!$registry->database)
        {
            throw new \Exception('Could not initialize Database!');
        }
        self::$registry = $registry;
    }
    
    /**
     * Summary of getRegistry
     * @return mixed
     */
    public static function getRegistry()
    {
        return self::$registry;
    }
}
