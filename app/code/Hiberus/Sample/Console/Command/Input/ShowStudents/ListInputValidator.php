<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 19:38
 */

namespace Hiberus\Sample\Console\Command\Input\ShowStudents;

use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ListInputValidator
 * @package Hiberus\Sample\Console\Command\Input\ShowStudents
 */
class ListInputValidator
{
    /**
     * Validate input options
     *
     * @param InputInterface $input
     * @return InputInterface
     */
    public function validate(InputInterface $input)
    {
        return $input;
    }
}
