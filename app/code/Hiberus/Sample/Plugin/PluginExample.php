<?php

namespace Hiberus\Sample\Plugin;

use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Api\Data\StudentSearchResultsInterface;
use Hiberus\Sample\Api\StudentRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class PluginExample
 * @package Hiberus\Sample\Plugin
 */
class PluginExample
{
    /**
     * @param StudentRepositoryInterface $subject
     * @param SearchCriteriaInterface $searchCriteria
     * @return array
     */
    public function beforeGetList(
        StudentRepositoryInterface $subject,
        SearchCriteriaInterface $searchCriteria
    ) {
        $searchCriteria->setPageSize(rand(1, 10));

        return [$searchCriteria];
    }

    /**
     * @param StudentRepositoryInterface $subject
     * @param callable $proceed
     * @param SearchCriteriaInterface $searchCriteria
     * @return StudentSearchResultsInterface
     * @throws LocalizedException
     */
    public function aroundGetList(
        StudentRepositoryInterface $subject,
        callable $proceed,
        SearchCriteriaInterface $searchCriteria
    ) {
        if(rand(1, 10) % 2 === 0) {
            return $proceed($searchCriteria); // Original function call
        }

        return $subject->getList($searchCriteria); // Not the original call
    }

    /**
     * @param StudentRepositoryInterface $subject
     * @param StudentSearchResultsInterface $result
     * @return StudentSearchResultsInterface
     */
    public function afterGetList(
        StudentRepositoryInterface $subject,
        $result
    ) {
        /** @var StudentInterface $first */
        $first = current($result->getItems());
        $first->setName('Daniel Delgado');

        return $result;
    }
}
