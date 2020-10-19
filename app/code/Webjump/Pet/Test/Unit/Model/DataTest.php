<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 13/10/20
 * Time: 16:46
 */

declare(strict_types=1);

namespace Webjump\Pet\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\Data;

class DataTest extends TestCase
{
    /** * @var Data */
    private $testClass;
    private $objectManager;
    private $scopeConfig;

    public function setup(): void
    {

        $this->scopeConfig = $this->createMock(ScopeConfigInterface::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(Data::class,
            [
                'scopeConfig' => $this->scopeConfig
            ]);
    }

    public function testGetConfigValue(): void
    {
        $this->scopeConfig
            ->expects($this->once())
            ->method('getValue')
            ->willReturn(true);

        $id = rand();

        //Act
        $actualResult = $this->testClass->getConfigValue($id);

        //Assert
        $this->assertEquals(true, $actualResult);
    }

    public function testGetGeneralConfig(): void
    {
        $this->scopeConfig
            ->expects($this->once())
            ->method('getValue')
            ->willReturn(true);

        $id = rand();

        //Act
        $actualResult = $this->testClass->getConfigValue($id);

        //Assert
        $this->assertEquals(true, $actualResult);
    }
}
