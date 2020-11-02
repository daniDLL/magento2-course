<?php

namespace Hiberus\Sample\Model\ResourceModel;

use Exception;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Hiberus\Sample\Api\Data\TeacherInterface;

/**
 * Class Teacher
 * @package Hiberus\Sample\Model\ResourceModel
 */
class Teacher extends AbstractDb
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

    protected function _construct()
    {
        $this->_init('hiberus_teacher', TeacherInterface::ID);
    }

    /**
     * Get all Student IDs for a teacher
     *
     * @param int $teacherId
     * @return array
     * @throws LocalizedException
     * @throws Exception
     */
    public function lookupStudentIds($teacherId)
    {
        $connection = $this->getConnection();

        $entityMetadata = $this->metadataPool->getMetadata(TeacherInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['ts' => $this->getTable('hiberus_teacher_student')], 'student_id')
            ->join(
                ['stud' => $this->getMainTable()],
                'stud.' . $linkField . ' = ts.' . $linkField,
                []
            )
            ->where('ts.' . $entityMetadata->getIdentifierField() . ' = :teacher_id');

        return $connection->fetchCol($select, ['teacher_id' => (int)$teacherId]);
    }

    /**
     * @param AbstractModel|TeacherInterface $object
     * @return $this|AbstractDb
     * @throws Exception
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @param AbstractModel|TeacherInterface $object
     * @param mixed $value
     * @param null $field
     * @return AbstractDb|mixed
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        return $this->entityManager->load($object, $value);
    }

    /**
     * @param AbstractModel|TeacherInterface $object
     * @return AbstractDb|void
     * @throws Exception
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
    }
}
