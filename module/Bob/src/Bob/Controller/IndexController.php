<?php
namespace Bob\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	public function indexAction()
	{
		$view = new ViewModel();
		$view->productType = "thisgetProductType";
		return $view;
	}

	public function registerAction()
	{
		$view = new ViewModel();
		$view->setTemplate('bob/pet/index');
		return $view;
	}

	public function getProductType($id)
	{
		$serviceLocator = $this->getServiceLocator();
		$adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->setArrayObjectPrototype(new \Bob\Model\DataObject\ProductType);
		$tableGateway = new \Zend\Db\TableGateway\TableGateway('bob', $adapter, null, $resultSet);

		$productTypeMapper = new \Bob\Model\DataMapper\ProductTypeMapper($tableGateway);
		
		$_id = (int) $id;
		return $productTypeMapper->getProductType($_id);
	}
}