<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:34
 */

namespace Hiberus\Library\Api;

use Hiberus\Library\Api\Data\BookInterface;
use Hiberus\Library\Api\Data\BookSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface BookRepositoryInterface
 * @package Hiberus\Library\Api
 */
interface BookRepositoryInterface
{
    /**
     * Save a Book
     *
     * @param BookInterface $book
     * @return BookInterface
     */
    public function save(Data\BookInterface $book);

    /**
     * Get Book by an Id
     *
     * @param int $bookId
     * @return BookInterface
     */
    public function getById($bookId);

    /**
     * Retrieve books matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return BookSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a Book
     *
     * @param BookInterface $book
     * @return bool
     */
    public function delete(Data\BookInterface $book);

    /**
     * Delete a Book by an Id
     *
     * @param int $bookId
     * @return bool
     */
    public function deleteById($bookId);
}
