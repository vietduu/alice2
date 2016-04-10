<?php
namespace Alice\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;
use Zend\Http\Request;
use Zend\Uri\Http;

class IndexController extends AbstractActionController
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
		$url = $request->getUri();

		$params = substr($url, strripos($url,'/')+1);

		$product_id = substr($params, strripos($params,'-')+1);

		$view->product_id = $product_id;
		
		$product_info = $this->getFullInformationById($product_id);
		$view->currentProduct = $product_info;

		$images = $this->getImagesFromProductId($product_id);
		$view->images = $images;

		return $view;
	}

	public function productUrlAction()
	{
		$view = new ViewModel();
		$request = $this->getRequest();
		$url = $request->getUri();

		$actualUrl = substr($url, 0, -1);
		$params = substr($actualUrl, strripos($actualUrl,'/')+1);

		$view->url = $params;
		$products = $this->getFullInformationByUrl($params);
		$view->products = $products[0];

		$defaultProduct = $products[0];
		$view->productName = $defaultProduct['name'];
		$view->invoiceName = $defaultProduct['invoice_type_name'];
		$view->productUrl = $defaultProduct['product_type_url'];
		$view->invoiceUrl = $defaultProduct['invoice_type_url'];

		if ($params === $defaultProduct['product_type_url']){
			$view->invoiceName = "";
		}

		$productArray = [];
		foreach ($products as $product){
			$productArray[] = $this->getFullInformationById($product['general_id'])[0];
		}

		$view->productArray = $productArray;

		return $view;
	}

	public function getFullInformationById($id)
	{
		$productById = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		$_id = (int) $id;
		return $productById->getFullInformationById($_id);
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

	public function getFullInformationByUrl($url)
	{
		$products = ConcreteServiceConfig::getGeneralProductServiceConfig($this);
		return $products->getFullInformationByUrl($url);
	}

	public function getImagesFromProductId($id)
	{
		$images = ConcreteServiceConfig::getImagesServiceConfig($this);
		return $images->getImagesFromProductId($id);
	}
}