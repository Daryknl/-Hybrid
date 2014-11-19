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

class Character
{
    protected $parent;
    
    protected $username;
    protected $motto;
    protected $credits;
    protected $pixels;
    
    protected $timeLastUsed;
    protected $timeCreated; 
    
    public function __construct($parent, $username, $motto, $credits, $pixels, $timeLastUsed = NULL, $timeCreated = NULL)
    {
    
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    public function getParent()
    {
        return $this->parent;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
}
