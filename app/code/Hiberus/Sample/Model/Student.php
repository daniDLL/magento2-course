<?php

namespace Hiberus\Sample\Model;

use Hiberus\Sample\Api\Data\StudentInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Student
 * @package Hiberus\Sample\Model
 */
class Student extends AbstractModel implements StudentInterface
{

    protected function _construct()
    {
        $this->_init(\Hiberus\Sample\Model\ResourceModel\Student::class);
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @return string
     */
    public function getBirthData()
    {
        return $this->_getData(self::BIRTH_DATA);
    }

    /**
     * @param int|mixed $id
     * @return StudentInterface|Student|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @param string $name
     * @return StudentInterface|Student
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @param string $birthData
     * @return StudentInterface|Student
     */
    public function setBirthData($birthData)
    {
        return $this->setData(self::BIRTH_DATA, $birthData);
    }

    /**
     * @param array|null $teacherIds
     * @return $this
     */
    public function setTeacherIds($teacherIds)
    {
        return $this->setData(self::TEACHER_IDS, $teacherIds);
    }

    /**
     * @return array|null
     */
    public function getTeacherIds()
    {
        return $this->_getData(self::TEACHER_IDS);
    }
}
