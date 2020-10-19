<?php

declare(strict_types=1);

namespace Webjump\PetGraphQl\Test\Unit\Model\Resolver;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use PHPUnit\Framework\TestCase;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponseFactory;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponse;
use Magento\Framework\GraphQl\Query\Resolver\BatchRequestItemInterface;
use Webjump\PetGraphQl\Model\Resolver\Pet;
use Webjump\Pet\Api\PetRepositoryInterface;

class PetTest extends TestCase
{
    private $testClass;
    private $objectManager;
    private $petRepository;
    private $field;
    private $context;
    private $resolveInfo;
    private $pet;
    private $batchResponseFactory;
    private $batchResponse;
    private $batchRequestItem;


    public function setup(): void
    {
        $this->petRepository = $this->createMock(PetRepositoryInterface::class);

        $this->field = $this->createMock(Field::class);

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfo = $this->createMock(ResolveInfo::class);

        $this->pet = $this->getMockBuilder(Pet::class)
            ->disableOriginalConstructor()
            ->setMethods(['getData'])
            ->getMock();

        $this->batchResponseFactory = $this->createMock(BatchResponseFactory::class);

        $this->batchResponse = $this->createMock(BatchResponse::class);

        $this->batchRequestItem = $this->createMock(BatchRequestItemInterface::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(Pet::class,
            [
                'batchResponseFactory' => $this->batchResponseFactory,
                'petRepository' => $this->petRepository
            ]);
    }

    public function testResolve()
    {
        //Arrange
        $requests = [$this->batchRequestItem];
        $args['entity_id'] = 10;
        $e = 'message';


        $this->batchResponseFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->batchResponse);

        $this->batchRequestItem
            ->expects($this->once())
            ->method('getArgs')
            ->willReturn($args);

        $this->petRepository
            ->expects($this->once())
            ->method('getById')
            ->with(10)
            ->willReturn($this->pet);

        $this->batchResponse
            ->expects($this->once())
            ->method('addResponse')
            ->with()
            ->willReturn([
                'name' => 'Labrador',
                'description' => 'cachorro'
            ]);

        //Act
        $actualResult = $this->testClass->resolve(
            $this->context,
            $this->field,
            $requests
        );

        //Assert
        $this->assertEquals($this->batchResponse, $actualResult);
        $this->assertInstanceOf(BatchResponse::class, $actualResult);
    }
}
