<?php
/**
 * @author: daniDLL
 * Date: 8/11/20
 * Time: 11:46
 */

namespace Hiberus\Sample\Helper;

/**
 * Class SlowLoading
 * @package Hiberus\Sample\Helper
 */
class SlowLoading
{
    public function __construct()
    {
        sleep(10);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return 'SlowLoading value';
    }
}
