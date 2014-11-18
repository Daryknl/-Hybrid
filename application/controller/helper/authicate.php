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

class Authicate
{
    protected static $auth = FALSE;
    
    public static function Login()
    {
        if(isset($_POST['email'], $_POST['password']) || isset($_POST['username'], $_POST['password']))
        {
            $useEmail = isset($_POST['email']) ? TRUE : FALSE;
            
            if($useEmail)
            {
                $account = filter_input(INPUT_POST, 'email');
            } else {
                $account = filter_input(INPUT_POST, 'username');
            }
            $password = filter_input(INPUT_POST, 'password');
            
            if(isset($account, $password))
            {
                // TODO: Validate Account
            }
            return FALSE;
        }
        return FALSE;
    }
    
    public static function Logout()
    {
        if(session_destroy())
        {
            self::$auth = FALSE;
            return TRUE;
        }
        return self::$aut;
    }
    
    public static function Forgot()
    {
        $email = isset($_POST, $_POST['email']) ? filter_input(INPUT_POST, 'email') : NULL;
			
		// If valid email and SMTP is enabled send user a email.
		if(is_null($email) == false && NULL)
		{
			// Email Authentication
			$database = array();
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			for($i = 0; $i < 16; ++1)
			{
				$x = rand(0, strlen($aplhabet) - 1);
				$database[] = $alphabet[ $x ];
			}
				
			$randomPassword = rand(1, 9999) . implode($database) . rand(32, 27);
				
			// Create Session Password
			// TODO: generate authenticationPasscode with mcrypt
			$_SESSION['passwordRecovery']['authenticationPasscode'] = NULL;
		}
			
		// Email Validation
		$auth = isset($_GET, $_GET['action'], $_GET['secret'], $_GET['session']) ? true : false;
			
		if($auth === true && $_GET['action'] == 'passwordRecovery')
		{
			$secret		= filter_input(INPUT_GET, 'secret');	// Session authenticationPasscode hash key
			$session	= filter_input(INPUT_GET, 'session');	// Session authenticationPasscode password
		}
    }
    
    public static function isAuthicated()
    {
        return (self::$auth == TRUE) ? TRUE : FALSE;
    }
}
