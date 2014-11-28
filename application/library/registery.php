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
 * TODO:
 *  Remove Registry.
 *  
 * Object Registery
 */
class Registery implements \Countable
{
    protected static $instance = NULL;
    
    protected $properties = array();
    
    public static function getInstance()
    {
        if(!self::$instance instanceof self)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    final public function __get($name)
    {
        return $this->properties[ $name ];
    }
    
    final public function __set($name, $value)
    {
        $this->properties[ $name ] = $value;
    }
    
    final public function getAll()
    {
        return $this->properties;
    }
    
    final public function count()
    {
        return count($this->properties);
    }
}
