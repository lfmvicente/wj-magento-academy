<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\PetController;

use Magento\Framework\App\Action\Action;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Model\PetRepository;
use Magento\Backend\App\Action\Context;

class Index extends Action
{

    private $petFactory;
    private $petRepository;

    public function __construct(
        PetInterfaceFactory $petFactory,
        PetRepository $petRepository,
        Context $context
    ) {
        parent::__construct($context);
        $this->petFactory = $petFactory;
        $this->petRepository = $petRepository;
    }

    public function execute()
    {
        $pet =  $this->petFactory->create();
        $pet->setName('Dog');
        $pet->setOwner('Felipe');
        $pet->setOwnerTelephone('11989896544');
        $pet->setOwnerId(1);
        $this->petRepository->save($pet);
    }
}
