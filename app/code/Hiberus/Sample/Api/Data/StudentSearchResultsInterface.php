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
     * @return \Hiberus\Sample\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * Set student list.
     *
     * @param \Hiberus\Sample\Api\Data\StudentInterface[] $items
     * @return \Hiberus\Sample\Api\Data\StudentSearchResultsInterface
     */
    public function setItems(array $items);
}
