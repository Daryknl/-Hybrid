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

    /**
     * This file is part of PicORM.
     *
     * PicORM is free software: you can redistribute it and/or modify
     * it under the terms of the GNU Lesser General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * PHP version 5.4
     *
     * @category Collection
     * @package  PicORM
     * @author   iNem0o <contact@inem0o.fr>
     * @license  LGPL http://opensource.org/licenses/lgpl-license.php
     * @link     https://github.com/iNem0o/PicORM
     */

    #namespace PicORM;
    namespace HybridCMS\Application\Library\Database;
    use Exception;
    
    class Database
    {
        protected $type;
        
        public function __construct($registry)
        {
            $database   = $registry->config->loadFile('connection');
            $this->type = strtoupper($database['type']);
            
            $dns = $registry->config->loadFile('dns');
            
            $register = '';
            
            if(in_array($this->type, $dns))
            {
                $register = str_replace(array('{hostname}', '{username}', '{password}', '{database}', '{port}'), array($database['hostname'], $database['username'], $database['password'], $dns[$this->type]['port']), $dns[$this->type]['dns']);
            } else {
                $register = str_replace(array('{hostname}', '{username}', '{password}', '{database}', '{port}'), array($database['hostname'], $database['username'], $database['password'], $dns['MYSQL']['port']), $dns['MYSQL']['dns']);
            }
            
            $connection = new PicORM();
            $connection::configure(array(
                'datasource' => new PDO($register, $database['username'], $database['password'])
            ));
            
            return $connection::getDataSource();
        }
        
        public function getConnection()
        {
            return $this->connection;
        }
    }
    
    class PicORM
    {
        /**
         * Datasource instance
         *
         * @var \PDO
         */
        protected static $_dataSource;

        /**
         * Configuration array
         *
         * @var array
         */
        protected static $_configuration;

        /**
         * Default PicORM configuration
         *
         * @var array
         */
        protected static $_defaultConfiguration = array(
            'cache'      => false, // !!TODO!!
            'datasource' => null
        );


        /**
         * Set PicORM global configuration
         *
         * @param array $configuration
         *
         * @throws Exception
         */
        final public static function configure(array $configuration)
        {
            // override with default configuration if not present
            $configuration += static::$_defaultConfiguration;

            // test if datasource is a PDO instance
            if ($configuration['datasource'] === null || !$configuration['datasource'] instanceof \PDO) {
                throw new Exception("PDO Datasource is required!");
            }

            // set global datasource for all model
            static::$_dataSource = $configuration['datasource'];
            Model::setDataSource(static::$_dataSource);

            // store PicORM configuration
            static::$_configuration = $configuration;
        }

        /**
         * Return main datasource extracted from configuration
         * @return \PDO
         */
        public static function getDataSource()
        {
            return static::$_dataSource;
        }
    }