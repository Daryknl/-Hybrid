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
use application\model\mapper\MapperInterface;

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
 * Summary of Emulator
 */
class Emulator extends AbstractEmulator
{
    # This is not how Emulators will be loaded or supported this is temperary for development and testing
    public static function fetch($emulator = NULL)
    {
        if(is_null($emulator) == true)
        {
            $app = \application\library\Configuration::get('app');
            $emulator = $app['emu'];
        }
        
        $data = NULL;
        if(file_exists( $data = sprintf('%s/data/%.json', dirname(__FILE__), $emulator) ))
        {
            $data = \application\input\JSON::jsonToArray( file_get_contents($data) );
        }
        
        return $data;
    }
    public function find($field = NULL)
    {
        return NULL;
    }
    public function send($mus = NULL)
    {
        return NULL;
    }
}
