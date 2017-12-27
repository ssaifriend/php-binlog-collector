<?php

namespace Binlog\Collector\External\Sentry;

use MySQLReplication\Binlog\Exception\BinlogException;

/**
 * Class BinlogRavenClient
 * @package Binlog\Collector\External\Sentry
 */
class BinlogRavenClient extends \Raven_Client
{
    /**
     * BinlogRavenClient constructor.
     *
     * @param mixed  $options_or_dsn
     * @param array  $options
     */
    public function __construct($options_or_dsn = null, $options = []) {
        parent::__construct($options_or_dsn, $options);
    }

    /**
     * @param string $exception
     * @param mixed  $data
     * @param mixed  $logger
     * @param mixed  $vars
     *
     * @return null|string|void
     */
    public function captureException($exception, $data = null, $logger = null, $vars = null)
    {
        if ($exception instanceof BinlogException
            && $exception->getMessage() === BinlogException::DISCONNECTED_MESSAGE) {
            return;
        }
        $data['level'] = self::ERROR;

        parent::captureException($exception, $data, $logger, $vars);
    }
}
