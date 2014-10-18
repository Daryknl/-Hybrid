<?php
    /**
     *	&HybridCMS
     *	CMS (Content Management System) for Habbo Emulators.
     *
     *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
     *	@version    0.0.5
     *	@link       http://github.com/GarettMcCarty/HybridCMS
     *	@license    Attribution-NonCommercial 4.0 International
     */

    # Application Namespace
    namespace HybridCMS\Application;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        global $config;

        echo 'Sorry a internal error occurred.';
        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }
    
    # Application Session
    ini_set('session.hash_function', 'whirlpool');
    
    if(!session_id()) {
        session_start();
    }
    
    # Application Autoload
    require( dirname(__FILE__) . '/library/autoload.php' );
    (new Library\Autoload)->register();
    
    # Application Registry
    $HybridRegistry = Library\Registry::getInstance();
    
    $HybridRegistry->author  = 'GarettisHere';
    $HybridRegistry->powered = 'HybridCMS';
    $HybridRegistry->version = '1.0.0';
    $HybridRegistry->license = 'Attribution-NonCommercial 4.0 International';
    
    # Application Configuration
    $HybridRegistry->config = new Library\Configuration();
    
    # Application Input Layer
    $input = file_get_contents('php://input');
    $HybridRegistry->requests = (array) json_decode($input, true);
    
    # Update POST Data.
    $_POST = array_merge($_POST, $HybridRegistry->requests);
    
    # Application Database Initialization.
    $database = $HybridRegistry->config->loadFile('connection');
    $database['type'] = isset($database['type']) ? $database['type'] : 'mysqli';
    
    switch($database['type']) {
        case 'mysql':
            $HybridRegistry->database = new Library\Database_Mysql();
            break;
        case 'mysqli':
            $HybridRegistry->database = new Library\Database_Mysqli();
            break;
        case 'pdo':
            $HybridRegistry->database = new Library\Database_PDO();
            break;
        default:
            $HybridRegistry->database = new Library\Database_Mysql();
    }
    
    $HybridRegistry->database->connect($database);