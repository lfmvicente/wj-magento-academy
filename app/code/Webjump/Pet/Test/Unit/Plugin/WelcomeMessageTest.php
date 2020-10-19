<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 13/10/20
 * Time: 19:21
 */

declare(strict_types=1);

namespace Webjump\Pet\Test\Unit\Plugin;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\GetPetNameForOnlineCustomer;
use Webjump\Pet\Plugin\WelcomeMessage;
use Magento\Theme\Block\Html\Header;

class WelcomeMessageTest extends TestCase
{
    /** @var GetPetNameForOnlineCustomer*/
    private $testClass;
    private $objectManager;
    private $getPetNameForOnlineCustomer;
    private $header;

    public function setup(): void
    {
        $this->getPetNameForOnlineCustomer = $this->getMockBuilder(GetPetNameForOnlineCustomer::class)
            ->disableOriginalConstructor()
            ->setMethods(['execute'])
            ->getMockForAbstractClass();

        $this->header = $this->createMock(Header::class);

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(WelcomeMessage::class,
            [
                'getPetNameForOnlineCustomer' => $this->getPetNameForOnlineCustomer
            ]);
    }

    public function testAfterGetWelcome(): void
    {
        $this->getPetNameForOnlineCustomer
            ->expects($this->once())
            ->method('execute')
            ->willReturn('');

        //Act
        $actualResult = $this->testClass->afterGetWelcome($this->header, 'result');

        //Assert
        $this->assertEquals('result', $actualResult);
    }
}
