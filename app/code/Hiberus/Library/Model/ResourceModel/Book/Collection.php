<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:36
 */

namespace Hiberus\Library\Model\ResourceModel\Book;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hiberus\Library\Model;

/**
 * Class Collection
 * @package Hiberus\Library\Model\ResourceModel\Book
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model\Book::class, Model\ResourceModel\Book::class);
    }
}
