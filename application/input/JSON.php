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

namespace application\input;

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

class JSON
{
    protected static $settings;
    protected static $object;
    protected static $raw;
    
    public static function jsonToArray($pData, $assoc= false, $depth = 512, $options = 0)
    {
        try {
            $object       = json_decode($pData, $assoc, $depth, $options);
            self::$raw    = $pData;
            self::$object = $object;
        } catch(\Exception $ex) {
            throw new \Exception($ex);
        }
        return (array) $object;
    }
    
    public static function jsonToXML($pData)
    {
        return NULL;
    }
    
    public static function angualarGET()
    {
        $input = file_get_contents('php://input');
        $json  = self::jsonToArray($input, true);
        
        return ($json);
    }
    
    public static function getRaw()
    {
        return self::$raw;
    }
    public static function getObject()
    {
        return self::$object;
    }
}
