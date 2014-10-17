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
    namespace HybridCMS\Application\Library;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        exit;
    }
    
    # Application Database Connection
    return 'a:5:{s:4:"type";s:6:"mysqli";s:8:"hostname";s:9:"127.0.0.1";s:8:"username";s:4:"root";s:8:"password";s:8:"may41997";s:8:"database";s:5:"habbo";}';