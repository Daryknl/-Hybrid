<?php
/**
 *	&HybridCMS
 *	CMS (Content Management System) for Habbo Emulators.
 *
 *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
 *	@version    1.0.0
 *	@link       http://github.com/GarettMcCarty/HybridCMS
 *	@license    Attribution-NonCommercial 4.0 International
 */

namespace application\controller\helper;

if(!defined('HybridSecure'))
{
    global $config;
    
    if(isset($config, $config['domain']))
    {
        $location = sprintf('Location: http://%s/404', $config['domain']);
        header($location);
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

class Encryption
{
    protected static $secret = NULL;
    protected static $string;
    
    public static function hash($string)
    {
        $hmac = $this->hmac($string);
        $salt = substr(strtr(self::create(35), '+', '.'), 0, 22);
        $cryp = crypt($hmac, 'blowfish'.$salt);
        
        return ($cryp);
    }
    public static function compare($string, $hashed)
    {
        
    }
    public static function create($bytes = 128)
    {
        if(function_exists('openssl_random_pseudo_bytes'))
        {
            return base64_encode(openssl_random_pseudo_bytes($bytes));
        } else {
            return base64_encode(mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM));
        }
    }
    public static function hmac($string)
    {
        if(self::$secret == NULL || empty(self::$secret))
        {
            $app = Configuration::get('app');
            self::$secret = $app['key'];
        }
        return hash_mac('sha512', $string, self::$secret);
    }
}
