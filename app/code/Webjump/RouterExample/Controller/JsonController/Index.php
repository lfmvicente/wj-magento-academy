<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\JsonController;

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
        //die("aqui");
        $resultJson = $this->resultJsonFactory->create();

        $response = ['success' => 'true'];
        $resultJson->setData($response);

        return $resultJson;
    }
}
