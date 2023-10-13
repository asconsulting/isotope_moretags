<?php

/**
 * Isotope More Tags
 *
 * Copyright (C) 2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/isotope_moretags
 * @link       https://andrewstevens.consulting
 */

 
 
/**
 * Hooks
 */
if (\Config::getInstance()->isComplete()) {
	$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('MoreTags\IsotopeMoreTags', 'insertTags');
}
