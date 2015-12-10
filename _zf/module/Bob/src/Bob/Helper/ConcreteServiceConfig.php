<?php

namespace Bob\Helper;
use Bob\Helper\ServiceConfigHelper;

class ConcreteServiceConfig
{
	public static function getGeneralProductServiceConfig($owner)
	{
		return ServiceConfigHelper::getServiceConfig($owner,
			'Bob\Model\DataObject\GeneralProduct',
			'general_product',
			'Bob\Model\DataMapper\GeneralProductMapper'
			);
	}

	public static function getInvoiceTypeServiceConfig($owner)
	{
		return ServiceConfigHelper::getServiceConfig($owner,
			'Bob\Model\DataObject\InvoiceType',
			'invoice_type',
			'Bob\Model\DataMapper\InvoiceTypeMapper');
	}

	public static function getProductTypeServiceConfig($owner){
		return ServiceConfigHelper::getServiceConfig($owner,
			'Bob\Model\DataObject\ProductType',
			'product_type',
			'Bob\Model\DataMapper\ProductTypeMapper');
	}
}