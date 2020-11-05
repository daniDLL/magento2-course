<?php
/**
 * @author: daniDLL
 * Date: 5/11/20
 * Time: 19:03
 */

namespace Hiberus\Sample\Observer;

use Hiberus\Sample\Api\Data\StudentSearchResultsInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class StudentRepositoryGetList
 * @package Hiberus\Sample\Observer
 */
class StudentRepositoryGetList implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var StudentSearchResultsInterface $searchResults */
        $searchResults = $observer->getEvent()->getData('search_results');

        $items = $searchResults->getItems();
        $items = array_reverse($items, false);

        $randomItem = $items[rand(0, count($items) - 1)];

        $items[] = $randomItem;

        $searchResults->setItems($items);
    }
}
