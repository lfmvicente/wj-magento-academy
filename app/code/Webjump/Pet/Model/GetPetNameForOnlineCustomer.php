<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 02/10/20
 * Time: 17:38
 */

declare(strict_types=1);

namespace Webjump\Pet\Model;

use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Webjump\Pet\Api\PetRepositoryInterface;

class GetPetNameForOnlineCustomer
{
    private $session;
    private $customerRepository;
    private $petRepository;

    public function __construct(
        Session $session,
        CustomerRepositoryInterface $customerRepository,
        PetRepositoryInterface $petRepository
    ) {
        $this->session = $session;
        $this->customerRepository = $customerRepository;
        $this->petRepository = $petRepository;
    }

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->create(\Psr\Log\LoggerInterface::class);

        try {
            $customer = $this->customerRepository->getById($this->session->getCustomerId());
        } catch(\Magento\Framework\Exception\LocalizedException $localizedException) {
            $logger->debug('Passou no catch');
            return '';
        }

        $customAttribute = $customer->getCustomAttribute('custom_attribute_pet');

        if ($customAttribute === null) {
            $logger->debug('Passou pelo null');
            return '';
        }
        $logger->debug('Final', [$customAttribute->getValue()]);
        try {
            $pet = $this->petRepository->getById((int) $customAttribute->getValue());
        } catch (\Magento\Framework\Exception\LocalizedException $localizedException) {
            $logger->debug('Passou no catch 2');
            return '';
        }
        $logger->debug('Pet name', [$pet->getName()]);
        return $pet->getName();
    }
}