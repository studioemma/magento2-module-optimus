<?php
/***
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace StudioEmma\Optimus\Test\Unit\Controller\Index;

/**
 * @group optimus
 */
class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $pageConfigMock = $this->getMockBuilder('Magento\Framework\View\Page\Config')
            ->disableOriginalConstructor()
            ->getMock();
        $pageFactory = $this->getMockBuilder('Magento\Framework\View\Result\PageFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $pageConfigMock->expects($this->exactly(2))->method('addBodyClass')->withConsecutive(
            ['page-content-examples'],
            ['cms-page-view']
        );
        $pageFactory->expects($this->once())->method('create');

        $controller = $objectManager->getObject(
            'StudioEmma\Optimus\Controller\Index\Index',
            [
                'pageConfig' => $pageConfigMock,
                'pageFactory' => $pageFactory
            ]
        );
        $controller->execute();
    }
}
