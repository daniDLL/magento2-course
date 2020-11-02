<?php

namespace Hiberus\Sample\Model\ResourceModel\Student\Relation;

use Hiberus\Sample\Api\Data\StudentInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Sample\Model\ResourceModel\Student;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ReadHandler
 * @package Hiberus\Sample\Model\ResourceModel\Student\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Student
     */
    private $resourceStudent;

    /**
     * ReadHandler constructor.
     * @param MetadataPool $metadataPool
     * @param Student $resourceStudent
     */
    public function __construct(
        MetadataPool $metadataPool,
        Student $resourceStudent
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceStudent = $resourceStudent;
    }

    /**
     * @param StudentInterface $entity
     * @param array $arguments
     * @return bool|object
     * @throws LocalizedException
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $studentTeacherId = $this->resourceStudent->lookupTeacherIds((int)$entity->getId());
            $entity->setTeacherIds($studentTeacherId);
        }

        return $entity;
    }
}
