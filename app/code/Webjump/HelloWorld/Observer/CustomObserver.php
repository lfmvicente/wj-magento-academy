<?php

declare(strict_types=1);

namespace Webjump\HelloWorld\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $event = $observer->getData('event');
    }
}
