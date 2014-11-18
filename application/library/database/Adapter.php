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

namespace application\library\database;
use application\library\Configuration;

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

class Adapter implements AdapterInterface
{
    protected $connection;
    protected $result;
    
    public function __construct($register)
    {
        if(!$register instanceof \application\library\Registry)
        {
            throw new \Exception('Database Adapter requires Registry Access');
        }
        
        Configuration::cache('connect');
        $this->connect();
    }
    
    public function connect()
    {
         $con = Configuration::get('connect');
         
         
        if(!$this->connection instanceof \PDO)
        {
            try {
                $this->connection = new \PDO($this->formatDNS(), $con['username'], $con['password']);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(\PDOException $ex) {
                throw new \Exception($ex);
            }
        }
    }
    
    public function formatDNS($type = 'mysql')
    {
        $type = strtoupper($type);
        
        $con = Configuration::get('connect');
        $dns = Configuration::get('dns');
        
        if(array_key_exists($type, $dns))
        {
            $dnsString = $dns[$type]['dns'];
        } else {
            $type = 'MYSQL';
            $dnsString = $dns[$type]['dns'];
        }
        
        $data = str_ireplace(['{hostname}', '{username}', '{password}', '{database}', '{port}'], [$con['hostname'], $con['username'], $con['password'], $con['database'], $con[$type]['port']], $dnsString);
        
        return ($data);
    }
    
    public function query($query)
    {
        if(!is_string($query))
        {
            throw new \Exception('Database query must be a string');
        }
        if(empty($query))
        {
            throw new \Exception('Database query can not be empty');
        }
        
        // connect
        $this->connect();
        
        if(!$this->result = $this->connection->query($query))
        {
            return FALSE;
            error_log('[DATABASE] >> Database Query Failed to Execute.');
        }
        
        return $this->result;
    }
    
    public function select($table, $where = '', $fields = '*', $limit = NULL, $offset = NULL)
    {
        $query = sprintf('SELECT %s FROM %s', $fields, $table);
        
        if($where != '' || isset($where))
        {
            $query .= sprintf(' WHERE %s', $where);
        }
        
        if($limit != NULL)
        {
            $query .= sprintf(' LIMIT %d', $limit);
        }
        
        if($limit != NULL && $offset != NULL)
        {
            $query .= sprintf(' OFFSET %d', $offset);
        }
        
        $this->query( $query );
        return $this->countRows();
    }
    
    public function insert($table, array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map(array($this, 'qouteValue'), array_values($data)));
        
        $query  = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, $fields, $values);
        
        $this->query($query);
        return $this->getInsertID();
    }
    
    public function update($table, array $data, $where = '')
    {
        $set = array();
        foreach($data as $field => $value)
        {
            $set[] = sprintf('%s=%s', $field, $this->qouteValue($value));
        }
        $set = implode(',', $set);
        
        $query = sprintf('UPDATE %s SET %s', $table, $set);
        
        if(!empty($where))
        {
            $query .= sprintf(' WHERE %s', $where);
        }
        
        $this->query($query);
        return $this->getAffectedRows();
    }
    
    public function delete($table, $where = '')
    {
        $query = sprintf('DELETE FROM %s', $table);
        
        if(!empty($where))
        {
            $query .= sprintf(' WHERE %s', $where);
        }
        
        $this->query($query);
        return $this->getAffectedRows();
    }
    
    private function qouteValue($value)
    {
        $this->connect();
        
        if(is_null($value))
        {
            $value = 'NULL';
        } else if(!is_numeric($value)) {
            $value = sprintf("'%s'", $value);
        }
        
        return $value;
    }
    
    public function fetch()
    {
        if($this->result !== NULL)
        {
            if($result = $this->result->fetch(PDO::FETCH_ASSOC) === false)
            {
                return $result;
            }
        }
        return false;
    }
    
    public function getInsertID()
    {
        $id =  ( $this->connection->lastInsertId );
        return isset($id) ? $id : NULL;
    }
    
    public function countRows()
    {
        return $this->result->fetchColumn();
    }
    public function getAffectedRows()
    {
        $affected = ($this->result->rowCount());
        return isset($affected) ? $affected : 0;
    }
}
