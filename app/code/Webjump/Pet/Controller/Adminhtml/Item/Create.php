<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 21/10/20
 * Time: 19:39
 */

namespace Webjump\Pet\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Create extends Action implements HttpGetActionInterface
{

    const ADMIN_RESOURCE = 'Webjump_Pet::pet_create';

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
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
