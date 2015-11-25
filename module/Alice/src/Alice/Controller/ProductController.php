<?php
namespace Alice\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Router\Http\Query;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;

class ProductController extends AbstractActionController
{
	public function indexAction()
	{
		$view = new ViewModel(array(
			'all_product_types' => $this->fetchAllProductTypes(),
			'product_type' => $this->getProductType(1),
			'all_general_products' => $this->fetchAllGeneralProducts(),
			'products_by_type_id' => $this->getProductsByProductTypeId(1),
			'product_info' => $this->getFullInformationByTypeId(1),
			'all_invoice_types' => $this->fetchAllInvoiceTypes(),
			'products_by_invoice_type' => $this->getProductInformationByInvoiceId(2),
			));
		return $view;
	}

	public function productAction()
	{
		$view = new ViewModel();
		$request = $this->getRequest();
		$product_id = (int)$request->getQuery('id');
		$view->product_id = $product_id;
		$product_info = $this->getProductById($product_id);
		$view->currentProduct = $product_info;

		return $view;
	}

	public function getProductById($id)
	{
		$productById = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		$_id = (int) $id;
		return $productById->getById($_id);
	}

	public function getProductType($id)
	{
		$productTypeMapper = ConcreteServiceConfig::getProductTypeServiceConfig($this);
		
		$_id = (int) $id;
		return $productTypeMapper->getById($_id);
	}

	public function fetchAllProductTypes()
	{
		$products = ConcreteServiceConfig::getProductTypeServiceConfig($this);
		return $products->fetchAll();
	}



	public function fetchAllGeneralProducts()
	{
		$general_products = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		return $general_products->fetchAll();
	}

	public function getProductsByProductTypeId($id)
	{
		$products = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		return $products->getProductsByProductTypeId($id);
	}

	public function getFullInformationByTypeId($id)
	{
		$product = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		return $product->getFullInformationByTypeId($id);
	}

	public function fetchAllInvoiceTypes()
	{
		$invoice_types = ConcreteServiceConfig::getInvoiceTypeServiceConfig($this);
		return $invoice_types->fetchAll();
	}

	public function getProductInformationByInvoiceId($id)
	{
		$products = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		return $products->getProductInformationByInvoiceTypeId($id);
	}
}