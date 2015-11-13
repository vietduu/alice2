<?php
namespace Alice\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;

class IndexController extends AbstractActionController
{
	public function indexAction()
	{
		$view = new ViewModel(array(
			'all_products' => $this->fetchAllProductTypes(),
			'product_type' => $this->getProductType(1),
			'all_general_products' => $this->fetchAllGeneralProducts(),
			'products_by_type_id' => $this->getProductsByProductTypeId(1),
			));
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
		$productTypeMapper = $this->getProductTypeServiceConfig();
		
		$_id = (int) $id;
		return $productTypeMapper->getById($_id);
	}


	private function getProductTypeServiceConfig(){
		return ServiceConfigHelper::getServiceConfig($this,
			'Bob\Model\DataObject\ProductType',
			'product_type',
			'Bob\Model\DataMapper\ProductTypeMapper');
	}

	public function fetchAllProductTypes()
	{
		$products = $this->getProductTypeServiceConfig();
		return $products->fetchAll();
	}

	private function getGeneralProductServiceConfig()
	{
		return ServiceConfigHelper::getServiceConfig($this,
			'Bob\Model\DataObject\GeneralProduct',
			'general_product',
			'Bob\Model\DataMapper\GeneralProductMapper'
			);
	}

	public function fetchAllGeneralProducts()
	{
		$general_products = $this->getGeneralProductServiceConfig();
		return $general_products->fetchAll();
	}

	public function getProductsByProductTypeId($id)
	{
		$products = $this->getGeneralProductServiceConfig();
		return $products->getProductsByProductTypeId($id);
	}
}