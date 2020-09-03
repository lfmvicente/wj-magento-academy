<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 01/09/20
 * Time: 16:57
 */

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\Index;

use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Action\Context;

class Sendemail extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $_request;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        Context $context,
        Http $request,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager
    )
    {
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this;




//        $store = $this->_storeManager->getStore()->getId();
//        $transport = $this->_transportBuilder->setTemplateIdentifier('routerexample_test_template')
//            ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
//            ->setTemplateVars(
//                [
//                    'store' => $this->_storeManager->getStore(),
//                ]
//            )
//            ->setFrom('general')
//            // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
//            ->addTo('lfm.vicente@gmail.com', 'Customer Name')
//            ->getTransport();
//        $transport->sendMessage();
//        return $this;
    }
}
