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
 * Autoloader - Loads classes automaticly.
 */
class autoloader
{
    protected static $loaded = array();
    
    public static function register()
    {
        spl_autoload_register('self::loader');
    }
    public static function unregister()
    {
        spl_autoload_unregister('self::loader');
    }
    
    public static function loader($className)
    {
        $className = strtolower($className);
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        
        if($lastNsPos = strripos('\\', $className))
        {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_ireplace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        
        $fileName .= str_ireplace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        
        require_once( dirname(__FILE__) . '/../../' . $fileName );
    }
}
