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

namespace application\model\mapper;
use application\library\database\Adapter;
use application\library\database\AdapterInterface;

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

class accountMap extends AbstractMapper
{
    protected $entity;
    protected $table = 'users';
    protected $class = '\application\model\Account';
    
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
    }
    
    protected function createEntity(array $data)
    {
        # How to make this multi-emulator :s ??
        $account = new $this->class(array(
            'id'        => $data['id'],
            'rank'      => $data['rank'],
            'password'  => $data['password'],
            'email'     => $data['mail']
        ));
        return ($this->entity = $account);
    }
    
    public function toArray()
    {
        return array(
            'id'        => $this->entity->id,
            'rank'      => $this->entity->rank,
            'password'  => $this->entity->password,
            'email'     => $this->entity->mail
        );
    }
    
    protected function test()
    {
        # For Those who are woundering
        # $test = new CharacterMap();
        # $test->update(
        #    new Account(array $entity)
        # );
    }
}
