<?php
namespace Bob\Helper;


class ServiceConfigHelper
{
	public static function getServiceConfig($owner, $modelName, $table, $mapper)
	{
		$serviceLocator = $owner->getServiceLocator();
		$adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->setArrayObjectPrototype(new $modelName);

		$tableGateway = new \Zend\Db\TableGateway\TableGateway($table, $adapter, null, $resultSet);

		$returning_mapper = new $mapper($tableGateway);

		return $returning_mapper;
	}
}