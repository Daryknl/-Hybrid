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
 * Abstract Database Mapper
 */
abstract class AbstractMapper
{
    protected $adapter;
    protected $table;
    protected $class;
    
    public function __construct(AdapterInterface $adapter, array $options = array())
    {
        $this->adapter = $adapter;
        
        if(isset($options['table']))
        {
            $this->table = $options['table'];
        } else {
            throw new \RuntimeException('The entity table has not been set');
        }
        if(isset($options['class']))
        {
            $this->class = $options['class'];
        } else {
            throw new \RuntimeException('The entity class has not been set');
        }
    }
    
    public function getAdapter()
    {
        return $this->adapter;
    }
    
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
    public function getTable()
    {
        return $this->table;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
    public function getClass()
    {
        return $this->class;
    }
    
    public function find($id, $conditions = '')
    {
        $this->adapter->select($this->table, "id=$id");
        
        if($result = $this->adapter->fetch())
        {
            return $this->createEntity((array)$result);
        }
        return false;
    }
    
    public function insert($entity)
    {
        if(!$entity instanceof $this->class)
        {
            throw new \InvalidArgumentException("The entity {$entity} must be an instance of {$this->class}");
        }
        
        return $this->adapter->insert($this->table, $entity->toArray());
    }
    
    public function update($entity)
    {
        if(!$entity instanceof $this->class)
        {
            throw new \InvalidArgumentException("The entity {$entity} must be an instance of {$this->class}");
        }
        
        $id     = $entity->id;
        $data   = $entity->toString();
        unset($data['id']);
        
        return $this->adapter->update($this->table, $data, "id = $id");
    }
    
    public function delete($id, $column = 'id')
    {
        if($id instanceof $this->class)
        {
            $id = $id->id;
        }
        return $this->adapter->delete($this->table, "$column = $id");
    }
    
    abstract protected function createEntity(array $data); 
}
