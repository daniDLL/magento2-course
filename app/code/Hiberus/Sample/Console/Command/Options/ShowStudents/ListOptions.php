<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 19:39
 */

namespace Hiberus\Sample\Console\Command\Options\ShowStudents;

/**
 * Class ListOptions
 * @package Hiberus\Sample\Console\Command\Options\ShowStudents
 */
class ListOptions
{
    /**
     * Show students options list
     *
     * @return array
     */
    public function getOptionsList()
    {
        return $this->getBasicOptions();
    }

    /**
     * Basic options
     *
     * @return array
     */
    private function getBasicOptions()
    {
        return [

        ];
    }
}
