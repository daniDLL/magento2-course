<?php

namespace Hiberus\Sample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface TeacherSearchResultsInterface
 * @package Hiberus\Sample\Api\Data
 */
interface TeacherSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get teacher list.
     *
     * @return TeacherInterface[]
     */
    public function getItems();

    /**
     * Set teacher list.
     *
     * @param TeacherInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
