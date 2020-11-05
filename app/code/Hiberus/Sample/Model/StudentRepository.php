<?php

namespace Hiberus\Sample\Model;

use Hiberus\Sample\Api\Data\StudentInterfaceFactory;
use Hiberus\Sample\Api\Data\StudentSearchResultsInterface;
use Hiberus\Sample\Model\ResourceModel\Student\Collection;
use Hiberus\Sample\Model\ResourceModel\Student\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
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
     * @var StudentInterfaceFactory
     */
    private $studentFactory;

    /**
     * @var CollectionFactory
     */
    private $studentCollectionFactory;

    /**
     * @var Data\StudentSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ManagerInterface
     */
    private $eventManager;

    /**
     * @param \Hiberus\Sample\Model\ResourceModel\Student $resourceStudent
     * @param StudentInterfaceFactory $studentFactory
     * @param CollectionFactory $studentCollectionFactory
     * @param Data\StudentSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ManagerInterface $eventManager
     */
    function __construct(
        ResourceModel\Student $resourceStudent,
        StudentInterfaceFactory $studentFactory,
        CollectionFactory $studentCollectionFactory,
        Data\StudentSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        ManagerInterface $eventManager
    ) {
        $this->resourceStudent = $resourceStudent;
        $this->studentFactory = $studentFactory;
        $this->studentCollectionFactory = $studentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->eventManager = $eventManager;
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

    /**
     * Retrieve students matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return StudentSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->studentCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\StudentSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        $this->eventManager->dispatch(
            'hiberus_sample_student_repository_get_list_after',
            [
                'search_results' => $searchResults
            ]
        );

        return $searchResults;
    }
}
