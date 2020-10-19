<?php

declare(strict_types=1);

namespace Webjump\PetGraphQl\Test\Unit\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Api\PetRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\PetGraphQl\Model\Resolver\DeletePet;

class DeletePetTest extends TestCase
{
    private $testClass;
    private $objectManager;
    private $petRepository;
    private $field;
    private $context;
    private $resolveInfo;


    public function setup(): void
    {
        $this->petRepository = $this->createMock(PetRepositoryInterface::class);

        $this->field = $this->createMock(Field::class);

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfo = $this->createMock(ResolveInfo::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(DeletePet::class,
            [
                'petRepository' => $this->petRepository
            ]
        );
    }

    public function testResolve()
    {
        //Arrange
        $args['entity_id'] = 10;
        $value = null;


        $this->petRepository
            ->expects($this->once())
            ->method('deleteById')
            ->with(10)
            ->willReturn(true);

        //Act
        $actualResult = $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo,
            $value,
            $args
        );

        //Assert
        $this->assertEquals(true, $actualResult);
    }

    public function testResolveWithInvalidId()
    {
        //Arrange
        $args['entity_id'] = null;
        $value = null;
        $e = 'message';


        $this->petRepository
            ->expects($this->once())
            ->method('deleteById')
            ->willThrowException(new \Exception($e));

        //Act
        $actualResult = $this->testClass->resolve(
            $this->field,
            $this->context,
            $this->resolveInfo,
            $value,
            $args
        );

        //Assert
        $this->assertEquals(false, $actualResult);
    }
}
