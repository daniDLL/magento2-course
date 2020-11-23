<?php
/**
 * @author: daniDLL
 * Date: 8/11/20
 * Time: 12:28
 */

namespace Hiberus\Sample\Cron;

use Psr\Log\LoggerInterface;

/**
 * Class Test
 * @package Hiberus\Sample\Cron
 */
class Test
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Test constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
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
