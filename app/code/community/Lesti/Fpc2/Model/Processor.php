<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 3:12 PM
 * To change this template use File | Settings | File Templates.
 */

/*+

*/
class Lesti_Fpc2_Model_Processor
{
    /**
     * @var Lesti_Fpc2_Model_Cache
     */
    protected $_cache;

    /**
     * @var array
     */
    protected $_html = array();

    /**
     * @var array
     */
    protected $_placeholder = array();

    /**
     * @param bool $content
     */
    public function extractContent($content)
    {
        $request = Mage::app()->getRequest();
        return $this->_processRequest($request);
    }

    protected function _processRequest(Mage_Core_Controller_Request_Http $request)
    {
        $requestHelper = new Lesti_Fpc2_Helper_Request();
        $key = $requestHelper->buildKey($request);
        $cache = $this->_getCache();
        $body = $cache->load($key);
        if ($body) {
            $session = new Lesti_Fpc2_Model_Session();
            $helper = new Lesti_Fpc2_Helper_Data();
            $blockHelper = new Lesti_Fpc2_Helper_Block();
            $dynamicBlocks = $helper->getDynamicBlocks();
            foreach ($dynamicBlocks as $nameInLayout) {
                $key = $blockHelper->buildKey($nameInLayout);
                $this->_html = $session->getBlockHtml($key);
                $this->_placeholder = $blockHelper->getPlaceholder($nameInLayout);
            }
            $body = str_replace($this->_placeholder, $this->_html, $body);
            return $body;
        }
    }

    protected function _getCache()
    {
        if (is_null($this->_cache)) {
            $this->_cache = new Lesti_Fpc2_Model_Cache();
        }
        return $this->_cache;
    }
}