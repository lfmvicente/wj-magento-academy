<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 23/09/20
 * Time: 17:29
 */

declare(strict_types=1);

namespace Webjump\Pet\Test\Unit\Model\ResourceModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\ResourceModel\GetAllPetTypeOptions;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Webjump\Pet\Model\ResourceModel\PetResourceFactory;

class GetAllPetTypeOptionsTest extends TestCase
{
    private $scopeConfigInterface;
    private $petResourceFactory;
    private $objectManager;
    /** @var GetAllPetTypeOptions */
    private $testClass;
    private $petResource;

    /**
     * @inheritdoc
     */
    public function setup(): void
    {
        $this->scopeConfigInterface = $this->getMockBuilder(ScopeConfigInterface::class)
            ->getMockForAbstractClass();

        $this->petResourceFactory = $this->createMock(PetResourceFactory::class);

        $this->petResource = $this->getMockBuilder(PetResource::class)
            ->disableOriginalConstructor()
            ->setMethods(['getTableName', 'getConnection', 'select', 'fetchAssoc'])
            ->getMock();

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(GetAllPetTypeOptions::class,
            [
                'scopeConfig' => $this->scopeConfigInterface,
                'petResourceFactory' => $this->petResourceFactory
            ]);
    }

    public function testExecute(): void
    {
        //Arrange
        $path = 'pet/general/enable';

        $this->scopeConfigInterface
            ->expects($this->once())
            ->method('getValue')
            ->with($path)
            ->willReturn(true);

        $this->petResourceFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petResource);

        $this->petResource
            ->expects($this->once())
            ->method('getConnection')
            ->willReturnSelf();

        $this->petResource
            ->expects($this->once())
            ->method('getTableName')
            ->with('pet_kind')
            ->willReturn('pet_kind');

        $select = $this->createMock(Select::class);

        $this->petResource
            ->expects($this->once())
            ->method('select')
            ->willReturn($select);

        $select
            ->expects($this->once())
            ->method('from')
            ->with(['pk' => 'pet_kind']);

        $this->petResource
            ->expects($this->once())
            ->method('fetchAssoc')
            ->willReturn([]);

        //Act
        $actualResult = $this->testClass->execute();

        //Assert
        $this->assertEquals([], $actualResult);
    }
}
