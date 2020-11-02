<?php

namespace Hiberus\Sample\Api;

use Hiberus\Sample\Api\Data\TeacherInterface;

/**
 * Interface TeacherRepositoryInterface
 * @package Hiberus\Sample\Api
 */
interface TeacherRepositoryInterface
{
    /**
     * Save a Teacher
     *
     * @param TeacherInterface $teacher
     * @return TeacherInterface
     */
    public function save(Data\TeacherInterface $teacher);

    /**
     * Get Teacher by an Id
     *
     * @param int $teacherId
     * @return TeacherInterface
     */
    public function getById($teacherId);

    /**
     * Delete a Teacher
     *
     * @param TeacherInterface $teacher
     * @return bool
     */
    public function delete(Data\TeacherInterface $teacher);

    /**
     * Delete a Teacher by an Id
     *
     * @param int $teacherId
     * @return bool
     */
    public function deleteById($teacherId);
}
