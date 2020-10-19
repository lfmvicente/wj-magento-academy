<?php

declare(strict_types=1);

namespace Webjump\PetGraphQl\Test\Unit\Model\Resolver;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Api\PetRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Webjump\PetGraphQl\Model\Resolver\Pet;
use Webjump\PetGraphQl\Model\Resolver\UpdatePet;

class UpdatePetTest extends TestCase
{
    private $testClass;
    private $objectManager;
    private $petRepository;
    private $field;
    private $context;
    private $resolveInfo;
    private $pet;


    public function setup(): void
    {

        $this->petRepository = $this->createMock(PetRepositoryInterface::class);

        $this->field = $this->createMock(Field::class);

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfo = $this->createMock(ResolveInfo::class);

        $this->pet = $this->getMockBuilder(PetInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getData', 'setData'])
            ->getMockForAbstractClass();

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(UpdatePet::class,
            [
                'petRepository' => $this->petRepository
            ]);
    }


    public function testResolveWillThrowGraphQlInputException(): void
    {
        $this->expectException(GraphQlInputException::class);

        $this->expectExceptionMessage('Missing input values');

        //Act
        $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo
        );
    }

    public function testResolveWillThrowGraphQlInputExceptionBecauseIdIsMissing(): void
    {
        $args['input'] = ['entity_id' => null];
        $value = null;

        $this->expectException(GraphQlInputException::class);

        $this->expectExceptionMessage('Missing id value');

        //Act
        $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo,
            $value,
            $args
        );
    }

    public function testResolve(): void
    {
        //Arrange
        $args['input'] = [
            'entity_id' => 10,
            'name' => 'Labrador',
            'description' => 'cachorro'
        ];

        $expectedResult['pet'] = [
            'entity_id' => 10,
            'name' => 'Labrador',
            'description' => 'cachorro'
        ];

        $value = null;

        $data ['input'] = [
            'entity_id' => 10,
            'name' => 'Labrador',
            'description' => 'cachorro'
        ];

        $this->petRepository
            ->expects($this->once())
            ->method('getById')
            ->with(10)
            ->willReturn($this->pet);

        $this->pet
            ->expects($this->once())
            ->method('setData')
            ->with($data['input']);

        $this->petRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->pet);

        $this->pet
            ->expects($this->once())
            ->method('getData')
            ->willReturn($expectedResult['pet']);

        //Act
        $actualResult = $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo,
            $value,
            $args
        );

        //Assert
        $this->assertEquals($expectedResult, $actualResult);
    }
}
