<?php

declare(strict_types=1);

namespace Webjump\HelloWorld\Plugin;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Event\ManagerInterface;
use Psr\Log\LoggerInterface;

class ActionPlugin
{
    private $logger;
    private $eventManager;

    public function __construct(LoggerInterface $logger, ManagerInterface $eventManager)
    {
        $this->logger = $logger;
        $this->eventManager = $eventManager;
    }

    public function beforeDispatch()
    {
        $this->logger->critical('Method before works!!!!!!');
    }

    public function aroundDispatch(Action $action, callable $proceed, $request)
    {
        $this->logger->debug('Method around works!!!!!');
        $result = $proceed($request);
        $this->logger->debug('Method around after proceed');
        return $result;
    }

    public function afterDispatch(Action $action, $request)
    {
        $this->logger->debug('Method After works!!!!!!');

        return $request;
    }
}
