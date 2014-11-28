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

namespace application\model\emulator;
use \application\model\mapper\MapperInterface;

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
 * Summary of AbstractEmulator
 */
abstract class AbstractEmulator implements EmulatorInterface
{
    # Emulator Object
    protected $emulator;
    
    public function __construct(EmulatorInterface $emulator)
    {
        if(!$emulator instanceof EmulatorInterface)
        {
            $message = sprintf('%s must be an instance of EmulatorInterface', (string)$emulator);
            throw new \RuntimeException($message);
        }
        
        $this->emulator = $emulator;
    }
    
    
    public abstract function find($field);
    public abstract function send($mus);
}
