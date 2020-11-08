<?php
/**
 * @author: daniDLL
 * Date: 8/11/20
 * Time: 12:28
 */

namespace Hiberus\Sample\Cron;

use Hiberus\Sample\Logger\SampleLogger;

/**
 * Class Test
 * @package Hiberus\Sample\Cron
 */
class Test
{
    /**
     * @var SampleLogger
     */
    protected $logger;

    /**
     * Test constructor.
     * @param SampleLogger $logger
     */
    public function __construct(
        SampleLogger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Write to system.log
     *
     * @return void
     */
    public function execute() {
        $this->logger->info('Cron Works');
    }
}
