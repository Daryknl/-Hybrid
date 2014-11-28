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

namespace application\model;

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

/**
 * Account Object Model
 * 
 * @see Hybird::Model
 */
class Account
{
    protected $id;
    protected $rank;
    protected $email;
    protected $password;
    
    public function __construct(array $entity)
    {
        $this->id       = $entity['id'];
        $this->rank     = $entity['rank'];
        $this->email    = $entity['mail'];
        $this->password = $entity['password'];
    }
    
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }
    
    public function setRank($rank)
    {
        $this->rank = $rank;
    }
    public function getRank()
    {
        return $this->rank;
    }
    
    public function setEmail($address)
    {
        $this->email = $address;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
}
