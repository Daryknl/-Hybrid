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

    $file = isset($_GET, $_GET['src']) ? $_GET['src'] : null;

    $theme = 'default'; // will be danimical got from db

    if(file_exists( $image = sprintf('themes/%s/img/%.png', $theme, $file) ) && is_null($file) == false) {
        echo base64_encode( file_get_contents($image) );   
    }