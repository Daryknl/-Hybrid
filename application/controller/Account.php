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

namespace application\controller;
use application\bootstrap;

if(!defined('HybridSecure'))
{
    if(class_exists('Configuration', true) !== false)
    {
        try {
            $application = Configuration::get('app');
            if(isset($application['url']))
            {
                $location = sprintf('Location: %s/404', $application['url']);
                header($location);
                unset($application);
            }
        } catch(\Exception $ex) {}
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

class Account extends Controller
{
    protected $roles;
    protected $account;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getByAccount($id = NULL)
    {
        if($id == NULL && !in_array('user_logged', $_SESSION))
        {
            return;
        }
        if($id == NULL)
        {
            $id = filter_input(INPUT_SESSION, 'user_id');
        }
        
        $registry = bootstrap::getRegistry();
        
        $accountData = [];
        $account  = $registry->database->select('users', array('id' => $id));
        
        $this->account = new \application\model\Account($account->fetch(\PDO::FETCH_ASSOC));
        $this->buildPrivilegeRights();
    }
    
    public function buildPrivilegeRights()
    {
        # Registry for Database Access
        $registry = bootstrap::getRegistry();
        
        $this->roles    = [];
        
        $query = sprintf('SELECT table1.role_id, table2.role_name FROM hybrid_user_rule as table1 JOIN hybrid_roles as table2 ON table1.role_id table2.role_id WHERE table1.user_id = %d', $account->getID());
        
        $statement = $registry->database->query($query);
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            $this->roles[ $row['rule_name'] ] = helper\Authicate::getPermissions( $row['role_id'] );
        }
    }
    
    public function hasPrivilege($permission)
    {
        foreach($this->roles as $role)
        {
            if($role->hasPermission($permission))
            {
                return true;
            }
        }
        return false;
    }
}