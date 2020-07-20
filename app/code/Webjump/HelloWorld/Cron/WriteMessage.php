<?php

declare(strict_types=1);

namespace Webjump\HelloWorld\Cron;

use Psr\Log\LoggerInterface;

class WriteMessage
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->critical('Hello World');
    }
}
