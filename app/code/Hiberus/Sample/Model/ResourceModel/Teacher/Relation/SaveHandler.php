<?php

namespace Hiberus\Sample\Model\ResourceModel\Teacher\Relation;

use Exception;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Sample\Api\Data\TeacherInterface;
use Hiberus\Sample\Model\ResourceModel\Teacher;

/**
 * Class SaveHandler
 * @package Hiberus\Sample\Model\ResourceModel\Teacher\Relation
 */
class SaveHandler implements ExtensionInterface
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
     * @throws Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(TeacherInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldStudents = $this->resourceTeacher->lookupStudentIds((int)$entity->getId());
        $newStudents = (array)$entity->getStudentIds();

        $table = $this->resourceTeacher->getTable('hiberus_teacher_student');

        $delete = array_diff($oldStudents, $newStudents);
        if ($delete) {
            $where = [
                $linkField . ' = ?' => $entity->getId(),
                'student_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStudents, $oldStudents);
        if ($insert) {
            $data = [];
            foreach ($insert as $studentId) {
                $data[] = [
                    $linkField => $entity->getId(),
                    'student_id' => (int)$studentId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
