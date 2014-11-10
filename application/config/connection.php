<?php
    /**
     *	&HybridCMS
     *	CMS (Content Management System) for Habbo Emulators.
     *
     *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
     *	@version    0.0.5
     *	@link       http://github.com/GarettMcCarty/HybridCMS
     *	@license    Attribution-NonCommercial 4.0 International
     */

    # Application Namespace
    namespace HybridCMS\Application\Config;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        exit;
    }
    
    # Application Database Connection
    return array(
        'type'  => 'mysql',
        
        'hostname'  => '127.0.0.1',
        'username'  => 'root',
        'password'  => '',
        'database'  => 'habbo'
    );