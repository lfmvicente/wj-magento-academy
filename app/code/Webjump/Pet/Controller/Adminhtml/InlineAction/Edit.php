<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Webjump\Pet\Controller\Adminhtml\InlineAction;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Webjump\Pet\Api\PetRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Psr\Log\LoggerInterface;

class Edit extends Action implements HttpPostActionInterface
{
    private $petRepository;
    private $logger;

    const ADMIN_RESOURCE = 'Webjump_Pet::pet_update';

    public function __construct(Context $context, PetRepositoryInterface $petRepository, LoggerInterface $logger)
    {
        $this->petRepository = $petRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Exception
     */
    public function execute()
    {
        $message = [];
        $errorMessage = [];

        $request = $this->_request->getParam('items');
        $items = array_pop($request);

        try {
            $pet = $this->petRepository->getById($items['entity_id']);

            $pet->setName($items['name']);
            $pet->setDescription($items['description']);

            $this->petRepository->save($pet);
        } catch (\Exception $exception) {
            $errorMessage[] = __($exception->getMessage());
        }

        $message[] = (isset($errorMessage)) ? $errorMessage : __('Register Successfully updated!');

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultPage->setData(['messages' => $message, 'error' => count($errorMessage)]);
    }
}

