<?php

use Awin\Common\Service\ApiAbstractService;
use Awin\Service\CurrencyWebserviceService;
use PHPUnit\Framework\TestCase;

class CurrencyWebserviceServiceTest extends TestCase
{
    /**
     * @dataProvider valueApiProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetValueApi($parameter, $expected): void
    {
        $mock = $this->getMockBuilder(CurrencyWebserviceService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('getExchangeRate')
            ->willReturn('(GBP) £'.filter_var($parameter, FILTER_SANITIZE_NUMBER_INT)*0.25);

        $mockedClass = $this->createMock(ApiAbstractService::class);
        $mockedClass->method('sendRequest')
            ->willReturn($expected);

        $this->assertEquals($expected, $mock->getExchangeRate($parameter));
    }

    public function valueApiProvider()
    {
        return [
            ['£100', '(GBP) £25'],
            ['£10', '(GBP) £2.5'],
            ['£1000', '(GBP) £250'],
            ['£10000', '(GBP) £2500'],
            ['£1', '(GBP) £0.25']
        ];
    }
}