<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 08/09/20
 * Time: 14:40
 */

declare(strict_types=1);

namespace Webjump\Pet\Controller\Adminhtml\Item;

use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * Create new pet kind action
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
    }
}