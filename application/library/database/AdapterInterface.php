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

interface AdapterInterface
{
    public function connect();
    public function disconnect();
    
    public function query($query);
    public function fetch();
    
    public function select($table, $conditions = '', $fields = '*', $order = '', $limit = NULL, $offset = NULL);
    public function update($table, array $data);
    public function delete($table, $conditions = '');
    
    public function getInsertID();
    public function countRows();
    public function getAffectedRows();
}
