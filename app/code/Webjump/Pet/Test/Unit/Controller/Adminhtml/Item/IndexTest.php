<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 06/10/20
 * Time: 19:23
 */

declare(strict_types=1);

namespace Webjump\Pet\Test\Unit\Controller\Adminhtml\Item;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Magento\Framework\View\Result\PageFactory;
use Webjump\Pet\Controller\Adminhtml\Item\Index;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Page\Config;

class IndexTest extends TestCase
{
    private $objectManager;
    private $testClass;
    private $resultPageFactory;
    private $page;
    private $config;

    public function setup(): void
    {
        $this->resultPageFactory = $this->createMock(PageFactory::class);

        $this->page = $this->getMockBuilder(Page::class)
            ->disableOriginalConstructor()
            ->setMethods(['setActiveMenu', 'addBreadcrumb', 'getConfig'])
            ->getMock();

        $this->config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->setMethods(['prepend', 'getTitle'])
            ->getMock();

        $this->objectManager = new ObjectManager($this);

        $this->testClass = $this->objectManager->getObject(Index::class,
            [
                'resultPageFactory' => $this->resultPageFactory
            ]);
    }

    public function testExecute()
    {
        //Arrange
        $this->resultPageFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->page);

        $this->page
            ->expects($this->once())
            ->method('setActiveMenu')
            ->willReturnSelf();

        $this->page
            ->expects($this->once())
            ->method('addBreadcrumb')
            ->willReturnSelf();

        $this->page
            ->expects($this->once())
            ->method('getConfig')
            ->willReturn($this->config);

        $this->config
            ->expects($this->once())
            ->method('getTitle')
            ->willReturnSelf();

        $this->config
            ->expects($this->once())
            ->method('prepend');

        //Act
        $actualResult = $this->testClass->execute();

        //Assert
        $this->assertEquals($actualResult, $this->page);
    }
}
