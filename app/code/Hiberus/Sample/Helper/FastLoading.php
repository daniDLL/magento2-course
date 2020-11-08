<?php
/**
 * @author: daniDLL
 * Date: 8/11/20
 * Time: 11:50
 */

namespace Hiberus\Sample\Helper;

/**
 * Class FastLoading
 * @package Hiberus\Sample\Helper
 */
class FastLoading
{
    /**
     * @var SlowLoading
     */
    protected $slowLoading;

    /**
     * FastLoading constructor.
     * @param SlowLoading $slowLoading
     */
    public function __construct(
        SlowLoading $slowLoading
    ){
        $this->slowLoading = $slowLoading;
    }

    /**
     * @return string
     */
    public function getFastValue()
    {
        return 'FastLoading value';
    }

    /**
     * @return string
     */
    public function getSlowValue()
    {
        return $this->slowLoading->getValue();
    }
}
