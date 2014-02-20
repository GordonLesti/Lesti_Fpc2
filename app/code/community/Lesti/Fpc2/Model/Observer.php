<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 4:34 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Model_Observer
 */
class Lesti_Fpc2_Model_Observer
{
    /**
     * @var array
     */
    protected $_placeholders = array();

    /**
     * @var array
     */
    protected $_html = array();

    public function httpResponseSendBefore($observer)
    {
        /** @var Lesti_Fpc2_Helper_Data $helper */
        $helper = Mage::helper('fpc2');
        if ($helper->isCacheUsed()) {
            /** @var Lesti_Fpc2_Helper_Request $requestHelper */
            $requestHelper = Mage::helper('fpc2/request');
            $request = Mage::app()->getRequest();
            if (in_array($requestHelper->getFullActionName($request), $helper->getCacheAbleActions())) {
                $key = $requestHelper->buildKey($request);
                /** @var Lesti_Fpc2_Model_Cache $cache */
                $cache = Mage::getSingleton('fpc2/cache');
                $body = $observer->getEvent()->getResponse()->getBody();
                $cache->save($body, $key);
                $body = str_replace($this->_placeholders, $this->_html, $body);
                $observer->getEvent()->getResponse()->setBody($body);
            }
        }
    }

    public function coreBlockAbstractToHtmlAfter($observer)
    {
        /** @var Lesti_Fpc2_Helper_Data $helper */
        $helper = Mage::helper('fpc2');
        if ($helper->isCacheUsed()) {
            /** @var Mage_Core_Block_Abstract $block */
            $block = $observer->getEvent()->getBlock();
            $nameInLayout = $block->getNameInLayout();
            if (in_array($nameInLayout, $helper->getDynamicBlocks())) {
                /** @var Lesti_Fpc2_Helper_Block $blockHelper */
                $blockHelper = Mage::helper('fpc2/block');
                $key = $blockHelper->getPlaceholder($nameInLayout);
                $this->_placeholders[] = $key;
                $this->_html[] = $observer->getTransport()->getHtml();
                $observer->getTransport()->setHtml($key);
            }
        }
    }
}