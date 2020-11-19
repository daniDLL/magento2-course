<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:34
 */

namespace Hiberus\Library\Api;

use Hiberus\Library\Api\Data\AuthorInterface;
use Hiberus\Library\Api\Data\AuthorSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface AuthorRepositoryInterface
 * @package Hiberus\Library\Api
 */
interface AuthorRepositoryInterface
{
    /**
     * Save a Author
     *
     * @param AuthorInterface $author
     * @return AuthorInterface
     */
    public function save(Data\AuthorInterface $author);

    /**
     * Get Author by an Id
     *
     * @param int $authorId
     * @return AuthorInterface
     */
    public function getById($authorId);

    /**
     * Retrieve authors matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return AuthorSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a Author
     *
     * @param AuthorInterface $author
     * @return bool
     */
    public function delete(Data\AuthorInterface $author);

    /**
     * Delete a Author by an Id
     *
     * @param int $authorId
     * @return bool
     */
    public function deleteById($authorId);
}
