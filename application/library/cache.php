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

class cache {
    protected $driver = null;
    
    public function __construct($driver = 'WinCacheDriver')
    {
        $_driver = sprintf('\application\library\cache\%s', $driver);
        
        if(!class_exists($_driver, true))
        {
            $_driver = "\application\library\cache\%s\APCDriver";
        }
        
        $this->driver = new $_driver;
    }
    
    public function create($key, $value)
    {
        return $this->driver->create($key, $value);
    }
    public function read($key)
    {
        return $this->driver->read($key);
    }
    public function update($key, $value)
    {
        return $this->driver->update($key, $value);
    }
    public function remove($key)
    {
        return $this->driver->remove($key);
    }
}
