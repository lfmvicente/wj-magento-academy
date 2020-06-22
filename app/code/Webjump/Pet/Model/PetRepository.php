<?php

declare(strict_types=1);

namespace Webjump\Pet\Model;

use Webjump\Pet\Api\PetRepositoryInterface;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Model\ResourceModel\Collection\PetCollectionFactory;
use Webjump\Pet\Model\ResourceModel\PetResourceFactory;
use Webjump\Pet\Api\Data\PetInterface;

class PetRepository implements PetRepositoryInterface
{

    private $petFactory;
    private $petCollectionFactory;
    private $petResourceFactory;

    public function __construct(
        PetInterfaceFactory $petFactory,
        PetCollectionFactory $petCollectionFactory,
        PetResourceFactory $petResourceFactory
    ) {
        $this->petFactory = $petFactory;
        $this->petCollectionFactory = $petCollectionFactory;
        $this->petResourceFactory = $petResourceFactory;
    }

    public function getById($petId)
    {
        $petResource = $this->petResourceFactory->create();
        $petModel = $this->petFactory->create();

        $petResource->load($petModel, $petId, 'entity_id');
        if (empty($petModel->getById())) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Could not find Pet with the id'));
        }
        return $petModel;
    }

    public function save(PetInterface $pet)
    {
        $petResource = $this->petResourceFactory->create();
        $petResource->save($pet);
    }
}
