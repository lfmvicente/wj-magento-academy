<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 21/10/20
 * Time: 19:43
 */

declare(strict_types=1);

namespace Webjump\Pet\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\PetRepositoryInterface;
use Magento\Backend\App\Action\Context;

class Save extends Action implements HttpPostActionInterface
{

    private $petFactory;
    private $petRepository;
    private $logger;

    const ADMIN_RESOURCE = 'Webjump_Pet::pet_create';

    public function __construct(
        Context $context,
        PetInterfaceFactory $petFactory,
        PetRepositoryInterface $petRepository
    ) {
        $this->petRepository = $petRepository;
        $this->petFactory = $petFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $params = $this->_request->getParams();
        $pet = $this->petFactory->create();

        try {

            if (!empty($params['entity_id'])) {
                $pet = $this->petRepository->getById($params['entity_id']);

            }

            $pet->setName($params['name']);

            if (!empty($params['description'])) {
                $pet->setDescription($params['description']);
            }

            $this->petRepository->save($pet);
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
            return $this->goBack();
        }

        $this->messageManager->addSuccessMessage(__('Record Saved Successfully'));
        return $this->goBack();
    }

    private function goBack()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('webjump_pet/item/index');
    }

}
