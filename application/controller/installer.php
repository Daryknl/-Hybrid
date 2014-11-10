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

    /**
     * Installer Controller
     */
    class Installer
    {
        # Current Installation Action
        protected $action = null;
        # Supported Modules
        protected $modules = array();
        
        # Configuration
        protected $configuration = array();
        
        public function __construct()
        {
            
        }
        
        public function initialize()
        {
            # Initialize html
            
            # Initialize drivers test and put test into modules var.
            
            # Display results
        }
        
        public function setAction($action = null)
        {
            $this->action = $action;
        }
        public function getAction()
        {
            return $this->action;
        }
    }