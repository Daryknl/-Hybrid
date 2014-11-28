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
use application\bootstrap;
use PDO;

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
    protected static $permissions = [];
    protected static $authicated  = FALSE;
    
    /*!
     * Authication Functions
     */
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
            self::$authicated = FALSE;
            return TRUE;
        }
        return self::$authicated;
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
			for($i = 0; $i < 16; ++$i)
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
    
    /*!
     * Permission Functions
     */
    public static function getPermissions($id)
    {
        $registry = bootstrap::getRegistry();
        $role     = new Authicate();
        
        
        $query = sprintf('SELECT table2.permission_desc FROM hybrid_role_permissions as table1 JOIN hybrid_permissions as table2 ON table1.permission_id = table2.permission_id WHERE table1.role_id = %d', (int)$id);
        $statement = $registry->database->query($query);
        
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $role::addPermission( $row['permission_desc'], true );
        }
        
        return $role;
    }
    
    public static function addPermission($key, $value)
    {
        self::$permissions [$key] = $value;
    }
    
    public static function hasPermission($key)
    {
        return isset( self::$permissions[$key] ) ? true : false;
    }
    
    /*!
     * Add or Remove Permissions
     */
    public static function insertRole($role)
    {
        $registry = bootstrap::getRegistry();
        
        return $registry->database->insert('hybrid_roles', array('role_name', $role));
    }
    public static function insertUserRole($id, $role)
    {
        $registry = bootstrap::getRegistry();
        
        return $registry->database->insert('hybird_user_role', array('user_id' => $id, 'role_id' => $role));
    }
    
    public static function removeRole($role)
    {
        $registry = bootstrap::getRegistry();
        
        $query = sprintf('DELETE table1, table2, table3 FROM hybrid_roles as table1 JOIN hybrid_user_role as table2 on table1.role_id = table2.role_id JOIN hybrid_role_permissionas table3 on table1.role_id = table3.role_id WHERE table1.role_id = %d', $role);
        return $registry->database->query($query);
    }
    public static function removeUserRole($role)
    {
        $registry = bootstrap::getRegistry();
        
        $query = sprintf('DELETE FROM hybrid_user_role WHERE hybrid_user = %d', $role);
        return $registry->database->query($query);
    }
}
