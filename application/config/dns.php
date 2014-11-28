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


return array(
    // Microsoft Database
    'DBLIB'    => array(
        'dns'  => 'dblib:host={hostname}:{port};dbname={database}',
        'port' => 10060,
    ),
    // MySQL Community Server
    'MYSQL'    => array(
        'dns'  => 'mysql:host={hostname};port={port};dbname={database}',
        'port' => 3306,
    ),
    // PostgreSQL
    'PGSQL'    => array(
        'dns'  => 'pgsql:host={hostname};port={port};dbname={database};user={username};password={password}',
        'port' => 5432,
    ),
);