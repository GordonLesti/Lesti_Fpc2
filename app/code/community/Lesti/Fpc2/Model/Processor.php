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