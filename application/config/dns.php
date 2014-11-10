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
    namespace HybridCMS\Application\Config;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        exit;
    }
    
    # No clue if any of these work xD
    
    # Only edit these if you know what your doing.
    return array(
        # 4D DNS Experimental
        '4D'     => array(
            'dns'  => '4D:host={hostname};charset=UTF-8',
            'port' => null
        ),
        # CURBID PDO DNS
        'CURBID' => array(
            'dns'  => 'cubrid:dbname={database};host={hostname};port={port}',
            'port' => 33000
        ),
        # Microsoft SQL Server
        'DBLIB' => array(
            'dns'  => 'dblib:host={hostname}:{port};dbname={database}',
            'port' => 10060
        ),
        # Firebird Server
        'FIREBIRD' => array(
            'dns'  => 'firebird:dbname={database};host={localhost}',
            'port' => null
        ),
        # MySQL Server
        'MYSQL' => array(
            'dns'  => 'mysq:host={hostname};port={port};dbname={database}',
            'port' => 3306
        ),
        # ODBC Server
        'ODBC' => array(
            'dns'  => 'odbc:Driver={SQL Native Client};Server={hostname};Database={database}; Uid={username};Pwd={password};',
            'port' => null
        ),
        # PostgreSQL
        'PGSQL' => array(
            'dns'  => 'pgsql:host={hostname};port={port};dbname={database};user={username};password={password}',
            'port' => 5432
        ),
    );