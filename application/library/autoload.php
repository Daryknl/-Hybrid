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
        global $config;

        echo 'Sorry a internal error occurred.';
        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }
    
    # Application Autoloader
    class Autoload {
        protected $loaded = array();
        
        public function register() {
            spl_autoload_register(array($this, 'preLoader'));
        }
        public function unregister() {
            spl_autoload_unregister(array($this, 'preLoader'));
        }
        
        /**
         * Pre Autoload Function
         * @param string $className
         * @return object
         */
        public function preLoader($className) {
            $className = str_ireplace('HybridCMS\\', '', $className);
            
            $this->loadClass($className);
            return;
            
            if(array_key_exists($className, $this->loaded)) {
                return $this->loaded[ $className ];
            } else {
                $this->loaded[ $className ] = $this->loadClass($className);
            }
        }
        
        /**
         * Actual Autoload Function
         * @param string $className - The class name the autoloader is loading.
         */
        public function loadClass($className) {
            $className = ltrim($className, '\\');
            $fileName  = '';
            $namespace = '';
            
            if($lastNsPos = strripos('\\', $className) == true) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName  = str_ireplace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
            
            if(file_exists( $include = sprintf('%s/%s', dirname(__FILE__) . '/../../', $fileName) )) {
                return require( $include );
            }
        }
    }
    