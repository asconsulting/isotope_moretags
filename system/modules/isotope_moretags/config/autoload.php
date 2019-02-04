<?php

/**
 * Isotope More Tags
 *
 * Copyright (C) 2019 Andrew Stevens Consulting
 *
 * @package    asconsulting/isotope_moretags
 * @link       https://andrewstevens.consulting
 */


 
/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'IsotopeAsc\IsotopeMoreTags' 	=> 'system/modules/isotope_moretags/library/IsotopeAsc/Backend/Attribute/MultiAliasCallback.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'iso_more_product_link' 		 => 'system/modules/isotope_moretags/templates/modules',
));
