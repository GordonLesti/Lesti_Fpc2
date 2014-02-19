<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 3:55 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Helper_Data
 */
class Lesti_Fpc2_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return array
     */
    public function getCacheAbleActions()
    {
        return array('cms_index_index', 'catalog_product_view', 'catalog_category_view', 'cms_page_view');
    }

    /**
     * @return array
     */
    public function getDynamicBlocks()
    {
        return array('top.links');
    }

    /**
     * @return bool
     */
    public function isCacheUsed()
    {
        return Mage::app()->useCache('fpc2');
    }
}