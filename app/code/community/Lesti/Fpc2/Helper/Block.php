<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 7:01 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Helper_Block
 */
class Lesti_Fpc2_Helper_Block extends Mage_Core_Helper_Abstract
{
    /**
     * @param $nameInLayout
     * @return string
     */
    public function buildKey($nameInLayout)
    {
        return '<!--' . md5($nameInLayout) . '-->';
    }
}