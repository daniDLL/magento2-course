<?php

namespace Hiberus\Sample\Api\Data;

/**
 * Interface StudentInterface
 * @package Hiberus\Sample\Api\Data
 */
interface StudentInterface
{
    const ID = 'entity_id';
    const NAME = 'name';
    const BIRTH_DATA = 'birth_data';
    const TEACHER_IDS = 'teacher_ids';

    /**
     * Get Student ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set Student ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Student Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set Student Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

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
     * @param mixed[]|null $teacherIds
     * @return $this
     */
    public function setTeacherIds($teacherIds);

    /**
     * @return mixed[]|null
     */
    public function getTeacherIds();
}
