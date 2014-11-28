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
 * Configuration
 * 
 * TODO:
 *  - Cache configuration files.
 */
class Configuration
{
    /**
     * Cache configuration files
     * @var aray
     */
    protected static $cache = null;
    
    public static function init()
    {
        if(!self::$cache instanceof cache)
        {
            //self::$cache = new cache();
        }
    }
    /**
     * Store Configuration For the given session
     * @param mixed $configFile 
     */
    public static function cache($config)
    {
        self::init();
        
        $file_location = sprintf('%s/../config/%s.php', dirname(__FILE__), $config);
        $file_content  = require_once($file_location);
        
        try {
            //$cache = self::$cache;
            //$cache->create($config, $file_content);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
        return false;
    }

    public static function get($config)
    {
        //self::init();
        
        //$cache = self::$cache;
        $file  = sprintf('%s/../config/%s.php', dirname(__FILE__), $config);
        
        //if(($cached = $cache->read($config)) === false)
        //{
            return require( $file );
        //}
        
        //return $cached;
    }
}
