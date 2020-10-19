<?php

declare(strict_types=1);

namespace Webjump\Pet\Test\Unit\Model\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\Source\PetTypeSource;
use Webjump\Pet\Model\ResourceModel\GetAllPetTypeOptions;

class PetTypeSourceTest extends TestCase
{
    private $testClass;
    private $getPetOptions;
    private $scopeConfig;
    private $objectManager;

    public function setup(): void
    {
        $this->getPetOptions = $this->createMock(GetAllPetTypeOptions::class);

        $this->scopeConfig = $this->createMock(ScopeConfigInterface::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(PetTypeSource::class,
            [
                'getPetOptions' => $this->getPetOptions,
                'scopeConfig' => $this->scopeConfig
            ]);
    }

    public function testGetAllOptions(): void
    {
        $item[] = [
            'name' => 'Nome',
            'entity_id' => 10
        ];

        $options[] = [
            'label' => $item[0]['name'],
            'value' => $item[0]['entity_id']
        ];

        $this->getPetOptions
            ->expects($this->once())
            ->method('execute')
            ->willReturn($item);

        $actualResult = $this->testClass->getAllOptions();

        $this->assertEquals($options, $actualResult);

    }
}
