<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 2/19/14
 * Time: 3:57 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class Lesti_Fpc2_Model_Cache
 */
class Lesti_Fpc2_Model_Cache extends Mage_Core_Model_Cache
{
    /**
     * Default options for default backend
     *
     * @var array
     */
    protected $_defaultBackendOptions = array(
        'hashed_directory_level'    => 3,
        'hashed_directory_umask'    => 0777,
        'file_name_prefix'          => 'fpc2',
    );

    public function __construct()
    {
        $node = Mage::getConfig()->getNode('global/fpc2');
        $options = array();
        if($node) {
            $options = $node->asArray();
        }
        parent::__construct($options);
    }
}