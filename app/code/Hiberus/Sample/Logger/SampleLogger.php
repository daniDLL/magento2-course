<?php
/**
 * @author: daniDLL
 * Date: 8/11/20
 * Time: 12:53
 */

namespace Hiberus\Sample\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Class SampleLogger
 * @package Hiberus\Sample\Logger
 */
class SampleLogger
{
    /**
     * @var PsrLoggerInterface
     */
    private $logger;

    /**
     * SampleLogger constructor.
     * @param PsrLoggerInterface $logger
     */
    public function __construct(
        PsrLoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param string $msg
     * @param array $context
     */
    public function debug($msg, array $context = [])
    {
        $this->logger->debug($msg, $context);
    }

    /**
     * @param string $msg
     * @param array $context
     */
    public function info($msg, array $context = [])
    {
        $this->logger->info($msg, $context);
    }
}
