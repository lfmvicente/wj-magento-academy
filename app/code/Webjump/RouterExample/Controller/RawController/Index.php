<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\RawController;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_RAW);
    }
}
