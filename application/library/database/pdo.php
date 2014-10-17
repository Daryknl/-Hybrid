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
    
    # Database
    class Database_PDO extends Database\Database {
        
        protected $connection;
        protected $credentials;
        
        protected $current;
        
        public function __construct($info = array()) {
            if(!empty($info)) {
                $this->credentials = $info;
            }
        }
        
        public function bindParam($param, $value) {
        
        }

        public function clear() {
            $this->current = null;
        }

        public function connect() {
            $dns = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $this->credentials['hostname'], $this->credentials['database']);
            try {
                $this->connection = new \PDO($dns, $this->credentials['username'], $this->credentials['password']);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(\PDOException $ex) {
                throw new \Exception($ex->getMessage());
            }
        }

        public function credentials($info) {
            if(!is_array($info)) {
                throw new \Exception("The database credentials must be an array.");
            }
            $this->credentials = $info;
        }

        public function disconnect() {
            $this->connection = null;
        }

        public function fetch($type) {

        }

        public function prepare($query) {

        }
        
        /**
         * Run a Query
         * @param type $statement
         * @return boolean
         */
        public function query($statement) {
            if($result = $this->connection->query($statement) == true) {
                return $result;
            }
            return false;
        }
        
        public function __destruct() {
            if($this->connection instanceof \PDO) {
                $this->disconnect();
            }
        }
    }