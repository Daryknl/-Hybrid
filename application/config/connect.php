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

namespace application\config;

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

return array(
    'type' => 'mysql',
    
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'hybrid',
);