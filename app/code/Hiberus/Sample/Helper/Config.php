<?php
/**
 * @author: daniDLL
 * Date: 15/11/20
 * Time: 19:19
 */

namespace Hiberus\Sample\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 * @package Hiberus\Sample\Helper
 */
class Config extends AbstractHelper
{
    const   XML_PATH_ENABLE =   'hiberus_sample/general_config/enable';
    const   XML_PATH_MULTIPLIER =   'hiberus_sample/general_config/multiplier';

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ENABLE
        );
    }

    /**
     * @return mixed
     */
    public function getMultiplier()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MULTIPLIER
        );
    }
}
