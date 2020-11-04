<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 19:16
 */

namespace Hiberus\Sample\Model;

use Hiberus\Sample\Api\Data\TeacherSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class TeacherSearchResults
 * @package Hiberus\Sample\Model
 */
class TeacherSearchResults extends SearchResults implements TeacherSearchResultsInterface
{
}
