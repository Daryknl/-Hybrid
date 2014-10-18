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
    
    # Encyption Helper
    class Encryption {
        protected $key = null;
        
        # Encryption Key
        public function setKey($key) {
            $this->key = $key;
        }
        
        # Create Hash 
        public function createHash($string) {
            $hmac = $this->hmac($string);
            $salt = substr(strtr($this->createKey(35), '+', '.'), 0, 22);
            
            return crypt($hmac, 'blowfish'.$salt);
        }
        # Compare Strings
        public function compareHash($string, $hashed) {
            $hmac = $this->hmac($string);
            return (crypt($hmac, $hashed) == $hashed) ? true : false;
        }
        # Create Hash Key
        public function createKey($bytes = 128) {
            if(function_exists('openssl_random_pseudo_bytes')) {
                return base64_encode(openssl_random_pseudo_bytes($bytes));
            } else {
                return base64_encode(mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM));
            }
        }
        # Generate a keyed hash value using the HMAC method
        public function hmac($string) {
            return hash_hmac('sha512', $string, $this->key);
        }
    }