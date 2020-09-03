<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\ForwardController;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action implements HttpGetActionInterface
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        $resultPage->setModule('routerexample')
            ->setController('pagecontroller')
            ->forward('index');

        return $resultPage;

        //return $resultPage->forward('routerexample/forwardcontroller/index');
    }
}
