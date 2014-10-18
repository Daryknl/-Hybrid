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
    namespace HybridCMS\Application\View;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        global $config;

        echo 'Sorry a internal error occurred.';
        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }
    
    class Admin {
        protected $username;
        protected $rank;
        
        public function __construct($username, $rank) {
            $this->username = $username;
            $this->rank     = $rank;
        }
        
        public function main() {}
        public function login() {}
        public function logout() {}
        
        public function accounts() {}
        public function account($id) {}
        
        public function articles() {}
        public function article($id) {}
        
        public function client() {}
        
        public function settings() {}
    }