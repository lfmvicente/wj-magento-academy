<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 13/10/20
 * Time: 19:36
 */

declare(strict_types=1);

namespace Webjump\PetGraphQl\Test\Unit\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Api\PetRepositoryInterface;
use Webjump\Pet\Model\Pet;
use Webjump\Pet\Model\PetFactory;
use Webjump\PetGraphQl\Model\Resolver\CreatePet;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;


class CreatePetTest extends TestCase
{

    private $testClass;
    private $objectManager;
    private $petFactory;
    private $petRepository;
    private $field;
    private $context;
    private $resolveInfo;
    private $pet;


    public function setup(): void
    {
        $this->petFactory = $this->createMock(PetFactory::class);

        $this->petRepository = $this->createMock(PetRepositoryInterface::class);

        $this->field = $this->createMock(Field::class);

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfo = $this->createMock(ResolveInfo::class);

        $this->pet = $this->createMock(Pet::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(CreatePet::class,
            [
                'petFactory' => $this->petFactory,
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

    public function testResolveWillThrowGraphQlInputExceptionBecauseNameIsMissing(): void
    {
        $args['input'] = ['name' => null];
        $value = null;

        $this->expectException(GraphQlInputException::class);

        $this->expectExceptionMessage('Missing name value');

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
            'name' => 'Labrador',
            'description' => 'cachorro'
        ];

        $value = null;

        $this->petFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->pet);

        $this->pet
            ->expects($this->once())
            ->method('setName')
            ->with('Labrador');

        $this->pet
            ->expects($this->once())
            ->method('setDescription')
            ->with('cachorro');

        $this->petRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->pet);

        $pet['pet'] = [
            'name' => 'Labrador',
            'description' => 'cachorro'
        ];

        $this->pet
            ->expects($this->once())
            ->method('getData')
            ->willReturn([
                'name' => 'Labrador',
                'description' => 'cachorro'
            ]);

        //Act
        $actualResult = $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo,
            $value,
            $args
        );

        //Assert
        $this->assertEquals($pet, $actualResult);
    }
}
