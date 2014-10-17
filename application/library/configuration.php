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

    /**
     *  RevolutionCMS 3.0 Configuration Handler
     *  @author     Kryptos
     *  @author     Heaplink
     *  @author     Joopie
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
    
    # Application Configuration Handler
    class Configuration {
        # Instance
        protected static $instance = null;
        
        public static function getInstance() {
            if(!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        
        # Configuration
        protected $configuration = array();
        
        public function __construct() {
            # Installation Check.
            
            # Proceed.
        }
        
        /**
         * Is HybridCMS Installed?
         * @return boolean
         */
        public function checkInstallation() {
            if(file_exists(dirname(__FILE__) . '/../storage/install.lock') == true) {
                return true;
            }
            return false; # HybridCMS was not installed.
        }
        
        /**
         * Redirect to Installation File or Recommed it.
         */
        public function redirectToInstall() {
            if(!headers_sent()) {
                header('Location: ./install.php');
            }
            # Header data must always go first.
            echo '<small>The Domain Given Might Not Be Correct</small><br />',
            sprintf('Please redirect to: %s://%s/install', strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, 5)) == 'https' ? 'https': 'http', $_SERVER['HTTP_HOST']);
        }
        
        /**
         * Load a configuration file.
         * @param string $fileName  - The name of the config file.
         * @return array
         * @throws \Exception
         */
        public function loadFile($fileName) {
            $location = sprintf('%s/../config/%s.php', dirname(__FILE__), $fileName);
            
            if(is_readable($location) && file_exists($location) && !isset($this->configuration[ sha1( $fileName ) ] )) {
                $this->configuration[ sha1( $fileName ) ] = unserialize( ($string = require($location)) );
            } else {
                throw new \Exception("The configuration file: ($fileName) was not found.");
            }
            
            return $this->configuration[ sha1( $fileName ) ];
        }
        
        public function saveFile($fileName, $object) {
            $data = '<?php'.PHP_EOL.'namespace HybridCMS\Application\Library;if(!defined(\'HybridSecure\')){exit;} return \''.serialize($object).'\';';
            $location = sprintf('%s/../config/%s.php', dirname(__FILE__), $fileName);
            
            if(!file_put_contents($location, $data)) {
                throw new \Exception("The configuration file: ($fileName) could not be updated.");
            }
        }
        
        /**
         * Load Configuration Value from Database.
         * @param string $table - The table for config.
         * @param string $key   - The configuration key.
         * 
         * @example $this->configuration[ sha1($table) ][$key] = $value;
         */
        public function loadDatabase($table, $key) {}
        /**
         * Save Configuration Value into Database.
         * @param type $table   - The Table Name
         * @param type $key     - The configuration key.
         * @param type $value   - The configuration value.
         */
        public function saveDatabase($table, $key, $value) {}
        
        /**
         * Retrieve All The configuration.
         * @return type
         */
        protected function getAll() {
            return $this->configuration;
        }
    }