<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:23
 */

namespace Hiberus\Library\Api\Data;

/**
 * Interface AuthorInterface
 * @package Hiberus\Library\Api\Data
 */
interface AuthorInterface
{
    const   TABLE   =   'hiberus_author';

    const   ID      =   'entity_id';
    const   NAME   =   'name';
    const   BIRTH_DATA    =   'birth_data';
    const   BIRTH_CITY  =   'birth_city';
    const   BOOK_IDS    =   'book_ids';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return AuthorInterface
     */
    public function setId($id);

    /**
     * @param string $name
     * @return AuthorInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $birthData
     * @return AuthorInterface
     */
    public function setBirthData($birthData);

    /**
     * @return string
     */
    public function getBirthData();

    /**
     * @return string
     */
    public function getBirthCity();

    /**
     * @param string $birthCity
     * @return AuthorInterface
     */
    public function setBirthCity($birthCity);

    /**
     * @return int[]
     */
    public function getBookIds();

    /**
     * @param int[] $bookIds
     * @return AuthorInterface
     */
    public function setBookIds($bookIds);
}
