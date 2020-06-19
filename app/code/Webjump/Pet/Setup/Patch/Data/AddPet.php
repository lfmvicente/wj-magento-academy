<?php

declare(strict_types=1);

namespace Webjump\Pet\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddPet implements DataPatchInterface
{

    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $data[] = [
            'pet_name'=>'Millow',
            'pet_owner'=>'Stanley',
            'created_at'=>'2020-06-16 12:00:00',
            'owner_telephone'=>'11985858283',
            'owner_id'=>2
        ];

        $data[] = [
            'pet_name'=>'Pakkun',
            'pet_owner'=>'Kakashi',
            'created_at'=>'2020-06-16 12:00:00',
            'owner_telephone'=>'11985858281',
            'owner_id'=>3
        ];

        $data[] = [
            'pet_name'=>'Pluto',
            'pet_owner'=>'Mickey',
            'created_at'=>'2020-06-16 12:00:00',
            'owner_telephone'=>'11985858283',
            'owner_id'=>2
        ];

        $this->moduleDataSetup->getConnection()->insertArray(
          $this->moduleDataSetup->getTable('pet_table'),
            ['pet_name', 'pet_owner', 'created_at', 'owner_telephone', 'owner_id'],
            $data
        );
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return[];
    }
}
