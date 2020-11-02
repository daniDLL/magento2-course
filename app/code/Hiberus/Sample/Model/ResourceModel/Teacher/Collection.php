<?php

namespace Hiberus\Sample\Model\ResourceModel\Teacher;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hiberus\Sample\Model;

/**
 * Class Collection
 * @package Hiberus\Sample\Model\ResourceModel\Teacher
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model\Teacher::class, Model\ResourceModel\Teacher::class);
    }
}
