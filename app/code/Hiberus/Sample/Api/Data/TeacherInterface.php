<?php

namespace Hiberus\Sample\Api\Data;

/**
 * Interface TeacherInterface
 * @package Hiberus\Sample\Api\Data
 */
interface TeacherInterface
{
    const ID = 'entity_id';
    const NAME = 'name';
    const BIRTH_DATA = 'birth_data';
    const STUDENT_IDS = 'student_ids';

    /**
     * Get the Teacher ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set the Teacher Id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get the Teacher Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Student Birth Data
     *
     * @return string
     */
    public function getBirthData();

    /**
     * Set Student Birth Data
     *
     * @param string $birthData
     * @return $this
     */
    public function setBirthData($birthData);

    /**
     * Set the Teacher Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @param array|null $studentIds
     * @return $this
     */
    public function setStudentIds($studentIds);

    /**
     * @return array|null
     */
    public function getStudentIds();
}
