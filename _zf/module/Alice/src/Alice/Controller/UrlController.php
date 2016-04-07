<?php
namespace Alice\Controller;
use Zend\Mvc\Controller\AbstractActionController;

class UrlController extends AbstractActionController
{
	public function indexAction(){
		die(var_dump($this->params('page')));
	}
}
