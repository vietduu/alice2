<?php
namespace Alice\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Alice\Controller\CmsController;

class RequestHandler extends AbstractHelper {
	public $cmsController;

	public function __invoke()
	{
		$cmsController = new CmsController();
		return $this;
	}

	public function getFolderKeyById($id=12)
	{
	//	$cmsController = new CmsController();
	//	return $cmsController->getFolderKeyById($id);
		return "bang-gia-hoa-don";
	}


	public function customizeRequest($url, $id){
		$ch = curl_init($url);
		$headers = array();
		$headers[] = "X-Accept-Code: " . $id;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}