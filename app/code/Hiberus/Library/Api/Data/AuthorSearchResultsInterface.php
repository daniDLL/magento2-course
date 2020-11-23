<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:35
 */

namespace Hiberus\Library\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface AuthorSearchResultsInterface
 * @package Hiberus\Library\Api\Data
 */
interface AuthorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get author list.
     *
     * @return AuthorInterface[]
     */
    public function getItems();

    /**
     * Set author list.
     *
     * @param AuthorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
