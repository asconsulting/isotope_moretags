<?php

/**
 * Isotope More Tags
 *
 * Copyright (C) 2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/isotope_moretags
 * @link       https://andrewstevens.consulting
 */



namespace IsotopeAsc;

use Haste\Data\Plain;
use Haste\Haste;
use Haste\Util\Format;
use Isotope\Isotope;
use Isotope\Interfaces\IsotopeAttributeWithOptions;
use Isotope\Interfaces\IsotopeProduct;
use Isotope\Model\Config;
use Isotope\Model\Product;
use Isotope\Model\ProductCollection\Cart;
use Isotope\Model\ProductCollection\Wishlist;
use Isotope\Model\ProductPrice;
use Isotope\Model\RequestCache;
use Isotope\Model\TaxClass;



class IsotopeMoreTags extends Isotope
{

	public function insertTags($strTag) 
	{
		if (stristr($strTag, "::") === FALSE) {
			return false;
		}
		
		$arrTag = explode("::", $strTag);
		
		if (substr($arrTag[0], 0, 8) != 'iso_more') {
			return false;
		}
		
		switch($arrTag[0]) {
			case 'iso_more_product':
				if (stristr($arrTag[2], ":") !== FALSE) {
					$arrLookup = explode(":", $arrTag[2]);
					switch ($arrLookup[0]) {
						case "id":
							$objProduct = Product::findByPk(intval($arrLookup[1]));
						break;
						case "sku":
							$objProduct = Product::findPublishedBy('sku', array($arrLookup[1]));
						break;
					}
					
					if (is_a($objProduct, "Contao\Model\Collection")) {
						$objProduct = $objProduct->current();
					}
				} else {
					$product_id = $arrTag[2];	
					$objProduct = Product::findByPk(intval($arrTag[2]));
				}
				
				if (!$objProduct) {
					return '';
				}
				
				switch ($arrTag[1]) {
					case 'url':
					case 'link':
						
						if (!$objProduct) { 
							return '';
						}
						
						if ($arrTag[3] != '') {
							$strTemplate = $arrTag[3];
						} else {
							$strTemplate = 'iso_more_product_link';
						}
						$objTemplate = new \FrontendTemplate($strTemplate);
						if (!$objTemplate) { 
							return '';
						}
						
						$arrCategories = $objProduct->getCategories();
						$objPage = \PageModel::findPublishedByIdOrAlias($arrCategories[0]);
						
						if ($objPage instanceof \Model\Collection){
							$objPage = $objPage->current();
						}
						
						if (!is_a($objPage, 'Contao\PageModel')) {
							return '';
						}
											
						$objTemplate->linkTitle = $objProduct->name;
						$objTemplate->link = $objProduct->sku;
						$objTemplate->href = $objProduct->generateUrl($objPage);
						
						$arrTemp = $objProduct->getAttributes();
						foreach ($arrTemp as $attribute) {
							$arrAttributes[$attribute] = $objProduct->{$attribute};
						}
						$objTemplate->product = $arrAttributes;
						
						return $objTemplate->parse();
					break;
				}
			break;
			
			case 'iso_more_order':
			
			break;
			
		}
		
	}
}
