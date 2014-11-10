<?php
    /**
     *	&HybridCMS
     *	CMS (Content Management System) for Habbo Emulators.
     *
     *	@author		GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
     *	@version	0.0.5
     *	@link		http://github.com/GarettMcCarty/HybridCMS
     *	@license	Attribution-NonCommercial 4.0 International
     */

    # Application Namespace
    namespace HybridCMS\Application\Controller\Helper;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        global $config;

        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        
        echo 'Sorry a internal error occurred.';
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }
    
    class Account
    {
        public function user() {
            return null;
        }
        public function exists ($character) {
            
        }
        public function banned ($character) {}
        
        public function information ($character) {}
        
        public function insert ($character) {}
        public function update ($character) {}
        public function delete ($character) {}
    }