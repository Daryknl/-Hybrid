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
    namespace HybridCMS\Application\Controller;
    
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
    
    class Admin {
        protected $registry;
        
        protected $authicated = false;
        protected $rank = 0;
        
        public function __construct($registry) {
            $this->registry = $registry;
            
            if(array_key_exists('authicated', $_SESSION)) {
                if(isset($_SESSION['authicated'], $_SESSION['authicated']['rank']) && $_SESSION['authicated']['rank'] >= 5) {
                    // Any tips on making this more secure?
                    // Email me at mrgarett@gmail.com
                    $_SESSION['admin'] = true;
                    
                    $this->authicated = true;
                    $this->rank = $_SESSION['authicated']['rank'];
                }
            }
        }
        
        public function run() {
            // TODO: Build Administration Panel
        }
        
        public function logout() {
            if($this->authicated == true) {
                $_SESSION['admin'] = false;
                $this->authicated  = false;
                return true;
            }
            return false;
        }
        
        public function addAccount($character) {
            if($this->rank >= 7) {
                
            }
            return false;
        }
        public function editAccount($character) {
            if($this->rank >= 5) { // Mods, Admins, Owner
                
                // Don't worry the view removes stuff mods should not edit.
            }
        }
        public function removeAccount($character) {
            if($this->rank >= 7) {
                
            }
            return false;
        }
        
        public function addArticle($article) {
            if($this->rank >= 5) { // Mods, Admins and owner should be able to add, edit and remove articles.
                
            }
            return false;
        }
        public function editArticle($article) {
            if($this->rank >= 5) { // Mods, Admins and owner should be able to add, edit and remove articles.
                
            }
            return false;
        }
        public function removeArticle($article) {
            if($this->rank >= 5) { // Mods, Admins and owner should be able to add, edit and remove articles.
                
            }
            return false;
        }
        
        public function editHotel($settings) {
            if($this->rank >= 7) {
                // Only Owner should be able to edit hotel settings if you believe admins should chnage 7 to a 6
            }
        }
    }