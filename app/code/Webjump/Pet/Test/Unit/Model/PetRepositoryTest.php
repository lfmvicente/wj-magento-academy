<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 29/09/20
 * Time: 17:27
 */

namespace Webjump\Pet\Test\Unit\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\Pet;
use Webjump\Pet\Model\PetRepository;
use Webjump\Pet\Model\ResourceModel\Collection\PetCollectionFactory;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Webjump\Pet\Model\ResourceModel\PetResourceFactory;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PetRepositoryTest extends TestCase
{
    private $petFactory;
    private $petCollectionFactory;
    private $petResourceFactory;
    private $objectManager;
    private $testClass;
    private $petResource;
    private $pet;
    private $abstractDb;

    public function setup(): void
    {
        $this->petFactory = $this->createMock(PetInterfaceFactory::class);

        $this->petResourceFactory = $this->createMock(PetResource::class);

        $this->petCollectionFactory = $this->createMock(PetCollectionFactory::class);

        $this->petResourceFactory = $this->createMock(PetResourceFactory::class);

        $this->petResource = $this->createMock(PetResource::class);

        $this->pet = $this->createMock(Pet::class);

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
            ->willReturn($this->pet);

        $this->petResource
            ->expects($this->once())
            ->method('load');

        $this->pet
            ->expects($this->once())
            ->method('getPetId')
            ->willReturn($id);

        //Act
        $actualResult = $this->testClass->getById($id);

        //Assert
        $this->assertEquals($this->pet, $actualResult);
    }

    public function testGetByIdWillThrowNoSuchException(): void
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
            ->willReturn($this->pet);

        $this->petResource
            ->expects($this->once())
            ->method('load');

        $this->expectException(NoSuchEntityException::class);

        $this->expectExceptionMessage('Could not find Pet with the id');

        //Act
        $this->testClass->getById($id);
    }

    public function testSave(): void
    {
        //Arrange
        $this->petResourceFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petResource);

        $this->petResource
            ->expects($this->once())
            ->method('save')
            ->with($this->pet)
            ->willReturnSelf();

        //Act
        $actualResult = $this->testClass->save($this->pet);

        //Assert
        $this->assertEquals($this->petResource, $actualResult);
    }

    public function testDeleteById(): void
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
            ->willReturn($this->pet);

        $this->petResource
            ->expects($this->once())
            ->method('load');

        $this->pet
            ->expects($this->once())
            ->method('getPetId')
            ->willReturn($id);

        $this->petResource
            ->expects($this->once())
            ->method('delete')
            ->with($this->pet);

        //Act
        $actualResult = $this->testClass->deleteById($id);

        //Assert
        $this->assertEquals('Pet Deleted', $actualResult);
    }

    public function testDeleteByIdWillThrowNoSuchException(): void
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
            ->willReturn($this->pet);

        $this->petResource
            ->expects($this->once())
            ->method('load');

        $this->expectException(NoSuchEntityException::class);

        $this->expectExceptionMessage('Could not find Pet with the id');

        //Act
        $this->testClass->deleteById($id);
    }
}
