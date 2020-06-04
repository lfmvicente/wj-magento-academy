<?php

declare(strict_types=1);

namespace Webjump\HelloWorld\Plugin;

use Magento\Framework\App\Action\Action;
use Psr\Log\LoggerInterface;

class ActionPlugin
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeDispatch()
    {
        $this->logger->info('Method before works!!!!!!');
    }

    public function afterDispatch(Action $action, $request)
    {
        $this->logger->info('Method After works!!!!!!');
        return $request;
    }
}
