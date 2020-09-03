<?php

declare(strict_types=1);

namespace Webjump\HelloWorld\Controller\TestController;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Index extends Action
{
    protected $resultJsonFactory;

    public function __construct(JsonFactory $resultJsonFactory, Context $context)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        echo "Hello World";
    }
}
