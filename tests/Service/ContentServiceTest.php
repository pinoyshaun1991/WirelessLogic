<?php

use WL\Common\Service\ScrapeService;
use WL\Service\ContentService;
use PHPUnit\Framework\TestCase;

class ContentServiceTest extends TestCase
{
    private $returnedItemsArray = array(
        array(
            'optionTitle' => 'Option 3600 Mins',
            'description' => 'Up to 3600 minutes talk time per year including 480 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '174',
            'discount'    => 'Save £18 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 2000 Mins',
            'description' => 'Up to 2000 minutes talk time per year including 420 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '108',
            'discount'    => 'Save £12 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 480 Mins',
            'description' => 'Up to 480 minutes talk time per yearincluding 240 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '66',
            'discount'    => 'Save £5 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 300 Mins',
            'description' => '300 minutes talk time per monthincluding 40 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '16',
            'discount'    => ''
        ),
        array
        (
            'optionTitle' => 'Option 160 Mins',
            'description' => 'Up to 160 minutes talk time per monthincluding 35 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '10',
            'discount'    => ''
        ),
        array
        (
            'optionTitle' => 'Option 40 Mins',
            'description' => 'Up to 40 minutes talk time per monthincluding 20 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '6',
            'discount'    => ''
        )
    );

    public function testGetContent(): void
    {
        $mock = $this->getMockBuilder(ContentService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->returnedItemsArray);

        $mockedClass = $this->createMock(ScrapeService::class);
        $mockedClass->method('getContents')
            ->willReturn($this->returnedItemsArray);

        $this->assertEquals($this->returnedItemsArray, $mock->getContent('https://videx.comesconnected.com/'));
    }
}