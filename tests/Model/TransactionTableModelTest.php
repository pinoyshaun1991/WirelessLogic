<?php

use PHPUnit\Framework\TestCase;
use Awin\Model\TransactionTableModel;

class TransactionTableModelTest extends TestCase
{

    private $returnedTransactionArray = array(
        array(
            'merchant' => 1,
            'date'     => '01/01/2020',
            'value'    => '(GBP) £2500'
        )
    );

    /**
     * @dataProvider merchantProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetMerchant($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setMerchant');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function merchantProvider()
    {
        return [
            ['Testing', 'Merchant is required and needs to be a positive number'],
            ['', 'Merchant is required and needs to be a positive number'],
            [array(), 'Merchant is required and needs to be a positive number'],
            [-12, 'Merchant is required and needs to be a positive number']
        ];
    }

    /**
     * @dataProvider merchantWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetMerchantWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setMerchant');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function merchantWithoutExceptionProvider()
    {
        return [
            [2, 2],
            [3, 3],
            [10, 10],
            [100, 100]
        ];
    }

    public function testGetMerchant(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getMerchant')
            ->willReturn(1);
        $this->assertEquals(1, $mockedClass->getMerchant());
    }

    /**
     * @dataProvider dateProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetDate($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDate');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function dateProvider()
    {
        return [
            ['2020/01/01', 'Date has to be valid and can not be null'],
            ['', 'Date has to be valid and can not be null'],
            [-12, 'Date has to be valid and can not be null']
        ];
    }

    /**
     * @dataProvider dateWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetDateWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDate');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function dateWithoutExceptionProvider()
    {
        return [
            ['01/01/2020', '01/01/2020'],
            ['15/01/2020', '15/01/2020'],
            ['01/06/2020', '01/06/2020'],
            ['03/07/2020', '03/07/2020']
        ];
    }

    public function testGetDate(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getDate')
            ->willReturn('01/01/2020');
        $this->assertEquals('01/01/2020', $mockedClass->getDate());
    }

    /**
     * @dataProvider valueProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetValue($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(TransactionTableModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setValue');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }
    public function valueProvider()
    {
        return [
            [null, 'Value can not be null'],
            ['abcdefg', 'Value needs to be a valid currency type']
        ];
    }

    public function testGetValue(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('getValue')
            ->willReturn(1000);
        $this->assertEquals(1000, $mockedClass->getValue());
    }

    public function testFetchTransactions(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('fetchTransactions')
            ->willReturn($this->returnedTransactionArray);
        $this->assertEquals($this->returnedTransactionArray, $mockedClass->fetchTransactions());
    }

    public function testFetchTransactionsById(): void
    {
        $mockedClass = $this->createMock(TransactionTableModel::class);
        $mockedClass->method('fetchTransactionByMerchantId')
            ->willReturn($this->returnedTransactionArray);
        $this->assertEquals($this->returnedTransactionArray, $mockedClass->fetchTransactionByMerchantId(1));
    }
}