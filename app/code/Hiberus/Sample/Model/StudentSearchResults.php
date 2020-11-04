<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 19:16
 */

namespace Hiberus\Sample\Model;

use Hiberus\Sample\Api\Data\StudentSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class StudentSearchResults
 * @package Hiberus\Sample\Model
 */
class StudentSearchResults extends SearchResults implements StudentSearchResultsInterface
{
}
