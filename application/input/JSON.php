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
 * JSON Tool
 */
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
        $data = self::jsonToArray($pData);
        
        $xml  = new \SimpleXMLElement("<?xml version=\"1.0\"?>");
        return $xml->asXML();
    }
    
    private static function jsonToXMLConvert($data, &$xml)
    {
        foreach($data as $key => $value)
        {
            if(is_array($value))
            {
                if(!is_numeric($key))
                {
                    $subnode = $xml->addChild("$key");
                    self::jsonToXMLConvert($value, $subnode);
                } else {
                    $subnode = $xml->addChild("item$key");
                    self::jsonToXMLConvert($value, $subnode);
                }
            } else {
                $xml->addChild("$key", htmlspecialchars("$value"));
            }
        }
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