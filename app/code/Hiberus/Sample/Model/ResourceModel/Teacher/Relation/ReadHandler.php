<?php

namespace Hiberus\Sample\Model\ResourceModel\Teacher\Relation;

use Hiberus\Sample\Api\Data\TeacherInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Sample\Model\ResourceModel\Teacher;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ReadHandler
 * @package Hiberus\Sample\Model\ResourceModel\Teacher\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Teacher
     */
    private $resourceTeacher;

    /**
     * @param MetadataPool $metadataPool
     * @param Teacher $resourceTeacher
     */
    public function __construct(
        MetadataPool $metadataPool,
        Teacher $resourceTeacher
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceTeacher = $resourceTeacher;
    }

    /**
     * @param TeacherInterface $entity
     * @param array $arguments
     * @return bool|object
     * @throws LocalizedException
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $teacherStudentId = $this->resourceTeacher->lookupStudentIds((int)$entity->getId());
            $entity->setStudentIds($teacherStudentId);
        }
        return $entity;
    }
}
