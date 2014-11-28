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
 * Character Object Model
 * 
 * @see Hybrid::Model
 */
class Character
{
    protected $parent;
    
    protected $username;
    protected $motto;
    protected $credits;
    protected $pixels;
    
    protected $timeLastUsed;
    protected $timeCreated; 
    
    public function __construct(array $entity)
    {
        # Character Parent
        $this->parent   = $entity[ 'parent' ];
        
        # Character Name
        $this->username = $entity['username'];
        # Character Motto
        $this->motto    = $entity['motto'];
        # Character Credits
        $this->credits  = $entity['credits'];
        # Character Pixels
        $this->pixels   = $entity['pixels'];
        # Character Last Login DateTime
        $this->timeLastUsed = $entity['timeLastUsed'];
        # Character Registration DateTime
        $this->timeCreated  = $entity['timeCreated'];
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
    
    public function setMotto($motto)
    {
        $this->motto = (string) $motto;
    }
    public function getMotto()
    {
        return $this->motto;
    }
    
    public function setCredits($coins)
    {
        $this->credits = $coins;
    }
    public function getCredits()
    {
        return $this->credits;
    }
    
    public function setPixels($points)
    {
        $this->pixels = $points;
    }
    public function getPixels()
    {
        return $this->pixels;
    }
    
    public function setTimeLastUsed($datetime)
    {
        $this->timeLastUsed = $datetime;
    }
    public function getTimeLastUsed()
    {
        return $this->timeLastUsed;
    }
    
    public function setTimeCreated($datetime)
    {
        $this->timeCreated = $datetime;
    }
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }
}
