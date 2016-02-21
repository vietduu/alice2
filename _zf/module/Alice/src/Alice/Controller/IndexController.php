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
	public $_dictionary = array('à' => 'a','á' => 'a','ả' => 'a','ã' => 'a','ạ' => 'a',
	'ă' => 'a','ằ' => 'a','ắ' => 'a','ẳ' => 'a','ẵ' => 'a','ặ' => 'a',
	'â' => 'a','ầ' => 'a','ấ' => 'a','ẩ' => 'a','ẫ' => 'a','ậ' => 'a',
	'đ' => 'd',
	'è' => 'e','é' => 'e','ẻ' => 'e','ẽ' => 'e','ẹ' => 'e',
	'ê' => 'e','ề' => 'e','ế' => 'e','ể' => 'e','ễ' => 'e','ệ' => 'e',
	'ì' => 'i','í' => 'i','ỉ' => 'i','ĩ' => 'i','ị' => 'i',
	'ò' => 'o','ó' => 'o','ỏ' => 'o','õ' => 'o','ọ' => 'o',
	'ô' => 'o','ồ' => 'o','ố' => 'o','ổ' => 'o','ỗ' => 'o','ộ' => 'o',
	'ơ' => 'o','ờ' => 'o','ớ' => 'o','ở' => 'o','ỡ' => 'o','ợ' => 'o',
	'ù' => 'u','ú' => 'u','ủ' => 'u','ũ' => 'u','ụ' => 'u',
	'ư' => 'u','ừ' => 'u','ứ' => 'u','ử' => 'u','ữ' => 'u','ự' => 'u',
	'ỳ' => 'y','ý' => 'y','ỷ' => 'y','ỹ' => 'y','ỵ' => 'y');

	public function formatUrl($input, $charset = 'UTF-8'){
	/*	$transferedUrl = iconv("UTF-8","ASCII//TRANSLIT", $input);
		$transferedUrl = preg_replace("/[^\w\s]+/","", $transferedUrl);
		$transferedUrl = strtolower(trim($transferedUrl));
		$transferedUrl = preg_replace("/[\/_+ |-]+/", "-", $transferedUrl);
		echo $transferedUrl;
		
		$strlen = mb_strlen($input, $charset);
    	while($strlen){
        	$array[] = mb_substr($input,0,1,$charset);
        	$transferedUrl = mb_substr($input, 1, $strlen, $charset);
        	$strlen = mb_strlen($input, $charset);
    	}

		for($i=0;$i<count($array);$i++){
        	foreach(self::$_dictionary as $_key => $_value) {
            	if ($array[$i] == $_key){
                	$array[$i] = $_value;
            	}
        	}
    	}

    	$implodeStr = implode("", $array);*/
    	$transferedUrl = $input;

    $strlen = strlen(utf8_decode($transferedUrl));
    while($strlen){
        $array[] = mb_substr($transferedUrl,0,1,$charset);
        $transferedUrl = mb_substr($transferedUrl, 1, $strlen, $charset);
        $strlen = mb_strlen($transferedUrl,$charset);
    }


    for($i=0;$i<count($array);$i++){
        foreach($_dictionary as $_key => $_value) {
            if ($array[$i] == $_key){
                $array[$i] = $_value;
            }
        }
    }

	return implode("", $array);
	}

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

//		$product_name = substr($params, 0)

//		$product_id = $request->getUri();

		$view->product_id = $product_id;
		
		$product_info = $this->getFullInformationById($product_id);
		$view->currentProduct = $product_info;

		$images = $this->getImagesFromProductId($product_id);
		$view->images = $images;

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

	public function getImagesFromProductId($id)
	{
		$images = ConcreteServiceConfig::getImagesServiceConfig($this);
		return $images->getImagesFromProductId($id);
	}
}