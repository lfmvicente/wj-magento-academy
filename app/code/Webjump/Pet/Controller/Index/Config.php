<?php

declare(strict_types=1);

namespace Webjump\Pet\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory = false;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Webjump_Pet::all_pets');
        $resultPage->addBreadcrumb(__('Hello'), __('Hello'));
        $resultPage->addBreadcrumb(__('World'), __('World'));
        $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));
        return $resultPage;
    }
}

