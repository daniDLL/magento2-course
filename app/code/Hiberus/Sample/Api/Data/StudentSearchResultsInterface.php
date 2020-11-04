<?php

namespace Hiberus\Sample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface StudentSearchResultsInterface
 * @package Hiberus\Sample\Api\Data
 */
interface StudentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get student list.
     *
     * @return StudentInterface[]
     */
    public function getItems();

    /**
     * Set student list.
     *
     * @param StudentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
