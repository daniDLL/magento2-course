<?php

namespace Hiberus\Sample\Model\ResourceModel\Student;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hiberus\Sample\Model;

/**
 * Class Collection
 * @package Hiberus\Sample\Model\ResourceModel\Student
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model\Student::class, Model\ResourceModel\Student::class);
    }
}
