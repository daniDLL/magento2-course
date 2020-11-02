<?php

namespace Hiberus\Sample\Model\ResourceModel;

use Exception;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Hiberus\Sample\Api\Data\StudentInterface;

/**
 * Class Student
 * @package Hiberus\Sample\Model\ResourceModel
 */
class Student extends AbstractDb
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param Context $context
     * @param MetadataPool $metadataPool
     * @param EntityManager $entityManager
     * @param string|null $connectionName
     */
    public function __construct(
        Context $context,
        MetadataPool $metadataPool,
        EntityManager $entityManager,
        $connectionName = null
    )
    {
        $this->metadataPool = $metadataPool;
        $this->entityManager = $entityManager;
        parent::__construct($context, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('hiberus_student', StudentInterface::ID);
    }

    /**
     * Get all Teacher IDs for a student
     *
     * @param int $studentId
     * @return array
     * @throws LocalizedException
     * @throws Exception
     */
    public function lookupTeacherIds($studentId)
    {
        $connection = $this->getConnection();

        $entityMetadata = $this->metadataPool->getMetadata(StudentInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['ts' => $this->getTable('hiberus_teacher_student')], 'teacher_id')
            ->join(
                ['stud' => $this->getMainTable()],
                'stud.' . $linkField . ' = ts.' . $linkField,
                []
            )
            ->where('ts.' . $entityMetadata->getIdentifierField() . ' = :student_id');

        return $connection->fetchCol($select, ['student_id' => (int)$studentId]);
    }

    /**
     * {@inheritDoc}
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return AbstractDb|mixed
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        return $this->entityManager->load($object, $value);
    }

    /**
     * @param AbstractModel $object
     * @return AbstractDb|void
     * @throws Exception
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
    }
}
