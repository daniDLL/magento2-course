<?php

namespace Hiberus\Sample\Api;

use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Api\Data\StudentSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface StudentRepositoryInterface
 * @package Hiberus\Sample\Api
 */
interface StudentRepositoryInterface
{
    /**
     * Save a Student
     *
     * @param StudentInterface $student
     * @return StudentInterface
     */
    public function save(Data\StudentInterface $student);

    /**
     * Get Student by an Id
     *
     * @param int $studentId
     * @return StudentInterface
     */
    public function getById($studentId);

    /**
     * Retrieve students matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Hiberus\Sample\Api\Data\StudentSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a Student
     *
     * @param StudentInterface $student
     * @return bool
     */
    public function delete(Data\StudentInterface $student);

    /**
     * Delete a Student by an Id
     *
     * @param int $studentId
     * @return bool
     */
    public function deleteById($studentId);
}
