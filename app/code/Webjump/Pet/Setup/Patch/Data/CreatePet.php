<?php

declare(strict_types=1);

namespace Webjump\Pet\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\PetRepositoryInterface;
use Magento\Setup\Module\DataSetup;

class CreatePet implements DataPatchInterface
{
    private $petFactory;
    private $petRepository;
    private $moduleDataSetup;

    public function __construct(
        PetInterfaceFactory $petFactory,
        PetRepositoryInterface $petRepository,
        DataSetup $moduleDataSetup
    ){
        $this->petFactory = $petFactory;
        $this->petRepository = $petRepository;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $pet = $this->petFactory->create();

        $pet->setName('Dog');
        $pet->setOwner('Eu');
        //$pet->setCreatedAt();
        $pet->setOwnerTelephone('1198989898');
        $pet->setOwnerId(4);

        $this->petRepository->save($pet);
        $this->moduleDataSetup->endSetup();
    }
}
