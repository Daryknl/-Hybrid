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

    # Application Security
    defined('HybridSecure') or define('HybridSecure', true);

    # Application Bootstrap
    require( dirname(__FILE__) . '/application/bootstrap.php' );