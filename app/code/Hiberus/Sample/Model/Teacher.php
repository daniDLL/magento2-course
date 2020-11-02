<?php

namespace Hiberus\Sample\Model;

use Magento\Framework\Model\AbstractModel;
use Hiberus\Sample\Api\Data\TeacherInterface;

/**
 * Class Teacher
 * @package Hiberus\Sample\Model
 */
class Teacher extends AbstractModel implements TeacherInterface
{

    protected function _construct()
    {
        $this->_init(ResourceModel\Teacher::class);
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * @param int|mixed $id
     * @return TeacherInterface|Teacher|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @param string $name
     * @return TeacherInterface|Teacher
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getBirthData()
    {
        return $this->_getData(self::BIRTH_DATA);
    }

    /**
     * @param string $birthData
     * @return Teacher
     */
    public function setBirthData($birthData)
    {
        return $this->setData(self::BIRTH_DATA, $birthData);
    }

    /**
     * @param array|null $studentIds
     * @return $this
     */
    public function setStudentIds($studentIds)
    {
        return $this->setData(self::STUDENT_IDS, $studentIds);
    }

    /**
     * @return array|null
     */
    public function getStudentIds()
    {
        return $this->_getData(self::STUDENT_IDS);
    }
}
