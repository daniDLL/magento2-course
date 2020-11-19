<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:36
 */

namespace Hiberus\Library\Model\ResourceModel\Author;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hiberus\Library\Model;

/**
 * Class Collection
 * @package Hiberus\Library\Model\ResourceModel\Author
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model\Author::class, Model\ResourceModel\Author::class);
    }
}
