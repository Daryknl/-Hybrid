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
    if(!defined('HybridSecure') && HybridSecure != 1) {
        global $config;

        echo 'Sorry a internal error occurred.';
        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }
    
    class Authicate {
        protected $encryption = null;
        protected $authicated = false;
        
        public function __construct() {
            if(array_key_exists('account', $_SESSION)) {
                $this->authicated = true;
            }
            
            if(!$this->encryption instanceof Encryption) {
                $this->encryption = new Encryption();
            }
        }
        
        public function login() {
            $email      = filter_input(INPUT_POST, 'email',     FILTER_SANITIZE_EMAIL);
            $username   = filter_input(INPUT_POST, 'username',  FILTER_SANITIZE_SPECIAL_CHARS);
            $password   = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_SPECIAL_CHARS);
            
            if(isset($email, $password) || isset($username, $password)) {
                
            }
            // automaticly false if they don't include email or username.
            return false;
        }
        public function logout() {
            $this->authicated = false;
            session_destroy();
        }
        
        public function isAuthicated() {
            return $this->authicated;
        }
    }