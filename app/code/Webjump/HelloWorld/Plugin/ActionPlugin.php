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
        $this->logger->info('Method before works!!!!!!');
        //$this->eventManager->dispatch('controller_action_predispatch');
    }
    public function afterDispatch(Action $action, $request)
    {
        $this->logger->info('Method After works!!!!!!');
        $this->eventManager->dispatch('controller_action_predispatch');
        return $request;
    }
}
