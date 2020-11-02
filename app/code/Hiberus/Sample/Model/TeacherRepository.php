<?php

namespace Hiberus\Sample\Model;

use Hiberus\Sample\Api\Data\TeacherInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\Sample\Api\Data;
use Hiberus\Sample\Api\TeacherRepositoryInterface;

/**
 * Class TeacherRepository
 * @package Hiberus\Sample\Model
 */
class TeacherRepository implements TeacherRepositoryInterface
{
    /**
     * @var \Hiberus\Sample\Model\ResourceModel\Teacher
     */
    private $resourceTeacher;

    /**
     * @var TeacherInterfaceFactory
     */
    private $teacherFactory;

    /**
     * @param \Hiberus\Sample\Model\ResourceModel\Teacher $resourceTeacher
     * @param TeacherInterfaceFactory $teacherFactory
     */
    public function __construct(
        ResourceModel\Teacher $resourceTeacher,
        TeacherInterfaceFactory $teacherFactory
    )
    {
        $this->resourceTeacher = $resourceTeacher;
        $this->teacherFactory = $teacherFactory;
    }

    /**
     * @param Data\TeacherInterface $teacher
     * @return Data\TeacherInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->save($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * @param int $teacherId
     * @return Data\TeacherInterface
     * @throws NoSuchEntityException
     */
    public function getById($teacherId)
    {
        /** @var Data\TeacherInterface $teacher */
        $teacher = $this->teacherFactory->create();
        $this->resourceTeacher->load($teacher, $teacherId);
        if (!$teacher->getId()) {
            throw new NoSuchEntityException(__('Teacher with id "%1" does not exist', $teacherId));
        }
        return $teacher;
    }

    /**
     * @param Data\TeacherInterface $teacher
     * @return bool|Data\TeacherInterface
     * @throws CouldNotSaveException
     */
    public function delete(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->delete($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * @param int $teacherId
     * @return bool|Data\TeacherInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($teacherId)
    {
        return $this->delete($this->getById($teacherId));
    }
}
