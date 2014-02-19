<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 4:12 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Helper_Request
 */
class Lesti_Fpc2_Helper_Request extends Mage_Core_Helper_Abstract
{
    /**
     * @param Mage_Core_Controller_Request_Http $request
     * @return string
     */
    public function buildKey(Mage_Core_Controller_Request_Http $request)
    {
        $requestUri = $request->getRequestUri();
        return md5($requestUri);
    }

    public function getFullActionName(Mage_Core_Controller_Request_Http $request)
    {
        return $request->getModuleName() . '_' .$request->getControllerName() . '_' .$request->getActionName();
    }
}