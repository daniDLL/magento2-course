<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:35
 */

namespace Hiberus\Library\Model;

use Hiberus\Library\Api\Data\AuthorInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Author
 * @package Hiberus\Library\Model
 */
class Author extends AbstractModel implements AuthorInterface
{

    protected function _construct()
    {
        $this->_init(\Hiberus\Library\Model\ResourceModel\Author::class);
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
     * @return AuthorInterface|Author|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @param string $name
     * @return AuthorInterface|Author
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @param string $birthData
     * @return AuthorInterface|Author
     */
    public function setBirthData($birthData)
    {
        return $this->setData(self::BIRTH_DATA, $birthData);
    }

    /**
     * @return string
     */
    public function getBirthCity()
    {
        return $this->_getData(self::BIRTH_CITY);
    }

    /**
     * @param string $birthCity
     * @return AuthorInterface
     */
    public function setBirthCity($birthCity)
    {
        return $this->setData(self::BIRTH_CITY, $birthCity);
    }

    /**
     * @return int[]
     */
    public function getBookIds()
    {
        return $this->_getData(self::BOOK_IDS);
    }

    /**
     * @param int[] $bookIds
     * @return AuthorInterface
     */
    public function setBookIds($bookIds)
    {
        return $this->setData(self::BOOK_IDS, $bookIds);
    }
}
