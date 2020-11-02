<?php

namespace Hiberus\Sample\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\Sample\Api\Data;
use Hiberus\Sample\Api\StudentRepositoryInterface;
use Hiberus\Sample\Model\ResourceModel;

/**
 * Class StudentRepository
 * @package Hiberus\Sample\Model
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @var \Hiberus\Sample\Model\ResourceModel\Student
     */
    private $resourceStudent;

    /**
     * @var \Hiberus\Sample\Api\Data\StudentInterfaceFactory
     */
    private $studentFactory;

    /**
     * @param \Hiberus\Sample\Model\ResourceModel\Student $resourceStudent
     * @param \Hiberus\Sample\Api\Data\StudentInterfaceFactory $studentFactory
     */
    function __construct(
        ResourceModel\Student $resourceStudent,
        Data\StudentInterfaceFactory $studentFactory
    )
    {
        $this->resourceStudent = $resourceStudent;
        $this->studentFactory = $studentFactory;
    }

    /**
     * @param Data\StudentInterface $student
     * @return Data\StudentInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\StudentInterface $student)
    {
        try {
            $this->resourceStudent->save($student);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $student;
    }

    /**
     * @param int $studentId
     * @return Data\StudentInterface
     * @throws NoSuchEntityException
     */
    public function getById($studentId)
    {
        $student = $this->studentFactory->create();
        $this->resourceStudent->load($student, $studentId);
        if (!$student->getId()) {
            throw new NoSuchEntityException(__('Student with id "%1" does not exist', $studentId));
        }
        return $student;
    }

    /**
     * @param Data\StudentInterface $student
     * @return bool|Data\StudentInterface
     * @throws CouldNotSaveException
     */
    public function delete(Data\StudentInterface $student)
    {
        try {
            $this->resourceStudent->delete($student);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $student;
    }

    /**
     * @param int $studentId
     * @return bool|Data\StudentInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($studentId)
    {
        return $this->delete($this->getById($studentId));
    }
}
