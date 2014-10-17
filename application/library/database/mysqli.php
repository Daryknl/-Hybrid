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
    use mysqli;
    
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
    class Database_Mysqli extends Database\Database {
        
        protected $connection;
        protected $statement;
        
        public function bindParam($param, $value) {
            
        }

        public function connect($credentials = array()) {
            
            $this->connection = new mysqli($credentials['hostname'], $credentials['username'], $credentials['password'], $credentials['database']);
        
            if($this->connection->connect_errno) {
                error_log(sprintf('[Database Error]: %d - %s', $this->connection->connect_errno, $this->connection->connect_error));
            }
            
            $this->connection->set_charset('utf8');
        }

        public function delete($table, $where = array()) {
            
        }

        public function disconnect() {
            if($this->connection instanceof mysqli) {
                $this->connection->close();
            }
        }

        public function fetch($type) {

        }

        public function insert($table, $variables = array()) {

        }

        public function prepare($statement) {

        }
        
        /**
         * Run Simple Query
         * @param string $statement - The query to run.
         * @return boolean          - Did the query run successfully.
         */
        public function query($statement) {
            if($success = $this->connection->query($statement) == true) {
                return $success;
            } else {
                error_log(sprintf('[Database Error]: %d - %s', $this->connection->errno, $this->connection->error));
            }
            return false;
        }
        
        public function update($table, $variables = array(), $where = array()) {
            # Prepared Statement
            $query = $this->connection->prepare('UPDATE ? SET ? WHERE ?');
            # Table
            $query->bind_param('s', $table);
            # Data to update
            $_vars = array();
            foreach( $variables as $key => $value ) {
                $_vars[] = sprintf('%s=\'%s\'', (string)$key, (string)$value);
            }
            $query->bind_param('s', implode(', ', $_vars));
            # From Where
            $query->bind_param('s', sprintf('%s=%s', $where[0], $where[1]));
            
            
        }
        
        public function __destruct() {
            $this->disconnect();
        }
    }