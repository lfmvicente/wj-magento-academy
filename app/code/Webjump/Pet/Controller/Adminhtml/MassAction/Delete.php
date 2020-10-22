<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Webjump\Pet\Controller\Adminhtml\MassAction;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Webjump\Pet\Api\PetRepositoryInterface;

class Delete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Webjump_Pet::pet_delete';

    private $petRepository;

    public function __construct(Context $context, PetRepositoryInterface $petRepository)
    {
        parent::__construct($context);
        $this->petRepository = $petRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $params = $this->_request->getParam('selected');

        if (empty($params)) {
            return $this->goBack();
        }

        foreach ($params as $id) {
            $this->petRepository->deleteById($id);
        }

        return $this->goBack();
    }

    private function goBack()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultPage->setPath('webjump_pet/item/index');
    }

}
