<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 29/09/20
 * Time: 17:27
 */

namespace Webjump\Pet\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\PetRepository;
use Webjump\Pet\Model\ResourceModel\Collection\PetCollection;
use Webjump\Pet\Model\ResourceModel\Collection\PetCollectionFactory;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Webjump\Pet\Model\ResourceModel\PetResourceFactory;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\Data\PetInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PetRepositoryTest extends TestCase
{
    private $petFactory;
    private $petCollectionFactory;
    private $petResourceFactory;
    private $objectManager;
    private $testClass;
    private $petResource;
    private $petInterface;
    private $abstractDb;

    public function setup(): void
    {
        $this->petFactory = $this->createMock(PetInterfaceFactory::class);

        $this->petResourceFactory = $this->createMock(PetResource::class);

        $this->petCollectionFactory = $this->createMock(PetCollectionFactory::class);

        $this->petResourceFactory = $this->createMock(PetResourceFactory::class);

        $this->petResource = $this->createMock(PetResource::class);

        $this->petInterface = $this->createMock(PetInterface::class);

        $this->abstractDb = $this->createMock(AbstractDb::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(PetRepository::class,
            [
                'petFactory' => $this->petFactory,
                'petCollectionFactory' => $this->petCollectionFactory,
                'petResourceFactory' => $this->petResourceFactory
            ]);
    }

    public function testGetById(): void
    {
        //Arrange
        $this->petResourceFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petResource);

        $id = rand();

        $this->petFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petInterface);

        $this->petResource
            ->expects($this->once())
            ->method('load');

        //Act
        $actualResult = $this->testClass->getById($id);

        //Assert
        $this->assertNull($actualResult);
    }
}
