<?php

namespace Hiberus\Sample\Model\ResourceModel\Student\Relation;

use Exception;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Model\ResourceModel\Student;

/**
 * Class SaveHandler
 * @package Hiberus\Sample\Model\ResourceModel\Student\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Student
     */
    protected $resourceStudent;

    /**
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
     * @throws Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(StudentInterface::class);

        $connection = $entityMetadata->getEntityConnection();

        $oldTeachers = $this->resourceStudent->lookupTeacherIds((int)$entity->getId());
        $newTeacher = (array)$entity->getTeacherIds();

        $table = $this->resourceStudent->getTable('hiberus_teacher_student');

        $delete = array_diff($oldTeachers, $newTeacher);
        if ($delete) {
            $where = [
                'student_id = ?' => $entity->getId(),
                'teacher_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newTeacher, $oldTeachers);
        if ($insert) {
            $data = [];
            foreach ($insert as $teacherId) {
                $data[] = [
                    'student_id' => $entity->getId(),
                    'teacher_id' => (int)$teacherId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
