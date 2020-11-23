<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:35
 */

namespace Hiberus\Library\Model;

use Hiberus\Library\Api\Data\BookInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Book
 * @package Hiberus\Library\Model
 */
class Book extends AbstractModel implements BookInterface
{

    protected function _construct()
    {
        $this->_init(\Hiberus\Library\Model\ResourceModel\Book::class);
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
    public function getTitle()
    {
        return $this->_getData(self::TITLE);
    }

    /**
     * @return string
     */
    public function getPublishDate()
    {
        return $this->_getData(self::PUBLISH_DATE);
    }

    /**
     * @param int|mixed $id
     * @return BookInterface|Book|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @param string $title
     * @return BookInterface|Book
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $publishDate
     * @return BookInterface|Book
     */
    public function setPublishDate($publishDate)
    {
        return $this->setData(self::PUBLISH_DATE, $publishDate);
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->_getData(self::RATING);
    }

    /**
     * @param string $rating
     * @return BookInterface
     */
    public function setRating($rating)
    {
        return $this->setData(self::RATING, $rating);
    }

    /**
     * @return int[]
     */
    public function getAuthorIds()
    {
        return $this->_getData(self::AUTHOR_IDS);
    }

    /**
     * @param int[] $authorIds
     * @return BookInterface
     */
    public function setAuthorIds($authorIds)
    {
        return $this->setData(self::AUTHOR_IDS, $authorIds);
    }
}
