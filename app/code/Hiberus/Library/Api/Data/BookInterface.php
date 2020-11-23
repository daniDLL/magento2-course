<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:23
 */

namespace Hiberus\Library\Api\Data;

/**
 * Interface BookInterface
 * @package Hiberus\Library\Api\Data
 */
interface BookInterface
{
    const   TABLE   =   'hiberus_book';

    const   ID      =   'entity_id';
    const   TITLE   =   'title';
    const   PUBLISH_DATE    =   'publish_date';
    const   RATING  =   'rating';
    const   AUTHOR_IDS  =   'author_ids';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return BookInterface
     */
    public function setId($id);

    /**
     * @param string $title
     * @return BookInterface
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $publishDate
     * @return BookInterface
     */
    public function setPublishDate($publishDate);

    /**
     * @return string
     */
    public function getPublishDate();

    /**
     * @return float
     */
    public function getRating();

    /**
     * @param float $rating
     * @return BookInterface
     */
    public function setRating($rating);

    /**
     * @return int[]
     */
    public function getAuthorIds();

    /**
     * @param int[] $authorIds
     * @return BookInterface
     */
    public function setAuthorIds($authorIds);
}
