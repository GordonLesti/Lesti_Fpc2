<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 7:15 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Model_Session
 */
class Lesti_Fpc2_Model_Session extends Zend_Session_Namespace
{
    const BLOCK_POSTFIX = 'Block';

    public function __construct()
    {
        parent::__construct('fpc2');
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getBlockHtml($key)
    {
        $key .= self::BLOCK_POSTFIX;
        return $this->$key;
    }

    /**
     * @param $key
     * @param $html
     * @return $this
     */
    public function setBlockHtml($key, $html)
    {
        $key .= self::BLOCK_POSTFIX;
        $this->$key = $html;
        return $this;
    }
}
