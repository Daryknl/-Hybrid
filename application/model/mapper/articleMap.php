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
 * Article Database Map
 */
class articleMap extends AbstractMapper
{
    protected $entity;
    protected $table = 'hybrid_articles';
    protected $class = '\application\model\Article';
    
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
    }
    
    protected function createEntity(array $data)
    {
        # Emulator
        $emulator = \application\model\emulator\Emulator::fetch();
        
        # Set Emulator Table
        $this->table = $emulator['fields']['articles']['table'];
        
        
        return ($this->entity = []);
    }
    
    public function toArray()
    {
        # Emulator
        $emulator = \application\model\emulator\Emulator::fetch();
        
        $this->test();
        
        return array(
            'id'        => $this->entity->id,
            'rank'      => $this->entity->rank,
            'password'  => $this->entity->password,
            'email'     => $this->entity->mail
        );
    }
    
    protected function test()
    {
        $emulator = \application\model\emulator\Emulator::fetch();
        var_dump($this->entity);
        var_dump($emulator['fields']['account']);
        exit;
        # For Those who are woundering
        # $test = new CharacterMap();
        # $test->update(
        #    new Account(array $entity)
        # );
    }
}
