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
    namespace HybridCMS\Application\Library\Database;
    
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
    
    # Database Interface
    abstract class Database {
        public abstract function connect( $credentials = array() );
        public abstract function disconnect();
        
        public abstract function query( $statement );
        
        public abstract function prepare( $statement );
        public abstract function bindParam( $param, $value );
        public abstract function fetch( $type );
        
        public abstract function insert( $table, $variables = array() );
        public abstract function update( $table, $where = array(), $variables = array() );
        public abstract function delete( $table, $where = array() );
        
        public function filter( $data ) {
            if(!is_array( $data )) {
                $data = trim(htmlentities( $data, ENT_QUOTES, 'UTF-8', false));
            } else {
                //Self call function to sanitize array data
                $data = array_map(array($this, 'filter'), $data);
            }
            return $data;
        }
        public function clean( $data ) {
            $data = stripslashes( $data );
            $data = html_entity_decode( $data, ENT_QUOTES, 'UTF-8' );
            $data = nl2br( $data );
            $data = urldecode( $data );
            return $data;
        }
    }