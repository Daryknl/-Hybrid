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
    namespace HybridCMS\Application\Library;
    
    use Countable;
    
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
    
    # Application Registry
    class Registry implements Countable {
        # Instance
        protected static $instance = null;
        
        public static function getInstance() {
            if(!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        # Registry
        
        /**
         * Store Registry Properties.
         */
        protected $properties = array();
        
        /**
         * Store a Registry Property
         * @param STRING $name  - The Alias.
         * @param OBJECT $value - The Object.
         */
        public function __set($name, $value) {
            $this->properties[ sha1($name) ] = $value;
        }
        
        /**
         * Retrieve a Registry Property
         * @param STRING $name - The Alias.
         * @return OBJECT
         */
        public function __get($name) {
            return $this->properties[ sha1($name) ];
        }
        
        /**
         * Retrieve All Properties.
         * @return ASSOC-ARRAY
         */
        public function getAll() {
            return $this->properties;
        }
        /**
         * Returns the Ammount of objects stored in are registry
         * @return INT
         */
        public function count() {
            return count($this->properties);
        }
    }