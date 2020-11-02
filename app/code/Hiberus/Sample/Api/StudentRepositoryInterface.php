<?php

namespace Hiberus\Sample\Api;

use Hiberus\Sample\Api\Data\StudentInterface;

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
