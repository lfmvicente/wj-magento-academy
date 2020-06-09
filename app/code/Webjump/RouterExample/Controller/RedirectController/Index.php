<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\RedirectController;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{

    protected $resultRedirectFactory;

    public function __construct(RedirectFactory $resultRedirectFactory, Context $context)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        $result->setPath('http://www.google.com');
        return $result;
    }
}
