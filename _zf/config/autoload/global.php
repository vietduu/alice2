<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
    	'driver'			=> 'Pdo',
    	'dsn'				=> 'mysql:dbname=bob_db;host=localhost',
    	'username'			=> 'admin',
    	'password'			=> 'admin',
    	'driver_options'	=> array(
    		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
    		),
    	),
    'service_manager' => array(
    	'factories' => array(
    		'Zend\Db\Adapter\Adapter'
    				=> 'Zend\Db\Adapter\AdapterServiceFactory',
    		),
    	),
    'view_manager' => array(
        'scheme' => 'https',
        'port' => null,
        'host' => 'localhost',
        'base_path' => '/alice2/public/',
    ),
);