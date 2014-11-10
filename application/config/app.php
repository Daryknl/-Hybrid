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
    
    # Application Configuration
    return array(
        // Application Hash Key
        'key'   => '',
        
        'debug' => false,
        'error' => 'hybrid.log',
        
        'env' => 0, // 0 = development, 1 = production
    );